<?php
//TODO *temp: add function when not connected to WS done temp solution try catch before save on setactions

namespace App\Http\Livewire;

use App\Models\ConfigAsArray;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\PelayananJadwal as PJ;
use App\Models\Config;
use App\Events\QueuesService;
use Auth;
//use LivewireUI\Modal\ModalComponent;


class StafPelayanan extends Component
{
    public $pid;
    public $loketAktif = null;
    public $loketList = [];
    public $pelayanan;
    public $looking;
    public $pelayananAktif;
    public $pelayananList;



      protected function getListeners()
    {
        return [
            "echo:QueuesEvent.stafroom.{$this->pid},QueuesService" => '$refresh',
            "setActions" => 'setAction',
            "refreshList" => '$refresh'
        ];
    }

    //protected $listeners = [,'setActions'=>'setAction','refreshList' => '$refresh'];



    public function mount()
    {
        $this->pelayanan = \App\Models\Pelayanan::find($this->pid);
        $this->pelayananAktif = $this->pelayanan->title;
        $loket = Config::where('title', 'loket_aktif')
            ->first()->refs
            ->where('pelaksana', '=', Auth::user()->profile->refs['fullname'])
            ->where('tanggal', '=', Carbon::now()->format('Y-m-d'))
            ->pluck('nama');

        $this->pelayananList = \App\Models\Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->where('id', '!=', $this->pid)
            ->get();

        if (count($loket) > 0)
            $this->loketAktif = $loket[0];
        // $this->loketList = Config::where('title', 'loket_pelayanan')->first()->refs;
    }

    public function render()
    {
        $date = Carbon::now()->format('Y-m-d');

        $today_coll = PJ::where('pelayanan_id', $this->pid)
                ->where('tanggal', '=', $date)
                ->where('refs->antrian', '!=', "")
                ->orderBy("refs->daftar",'desc')
                ->orderBy("refs->antrian")

                ->get();


        $waiting_coll = $today_coll->filter(function ($item, $key)  {
            return $item->refs['status'] =="menunggu";
        });

        $pending_coll = $today_coll->filter(function ($item, $key)  {
            return $item->refs['status'] =="pending";
        });

        $calling_coll = $today_coll->filter(function ($item, $key)  {
            return $item->refs['status'] =="panggil";
        });

        $processing_coll = $today_coll->filter(function ($item, $key)  {
            return $item->refs['status'] =="berjalan";
        });

        $completed_coll = $today_coll->filter(function ($item, $key)  {
            return $item->refs['status'] =="selesai";
        });

        $absent_coll = $today_coll->filter(function ($item, $key) {
            return $item->refs['status'] == "tidak_hadir";
        });


        return view('livewire.staf-pelayanan', [
            'collection'=>$waiting_coll,
            'collection_pending'=>$pending_coll,
            'collection_memanggil'=>$calling_coll,
            'collection_berjalan'=>$processing_coll,
            'collection_selesai'=>$completed_coll,
            'collection_tidakhadir'=>$absent_coll,
             'date' => Carbon::now()->translatedFormat('d F Y'),
            ]);
    }

    public function setAction($id, $act,$openmodal=false,$closeModal=false)
    {

         try{

             DB::connection('mysql')->beginTransaction();

        //dd($closeModal);
        if(empty($this->loketAktif)){
            return $this->dispatchBrowserEvent('loketIsEmpty');
        }


        $item = PJ::find($id);
        $type = "staff";
        $keys_call = 0;
        $token_call = "";
        $name_call = "";


        if($act == "edit_biodata") {

            $this->emit('openModal', 'staff-pelayanan-modal-call',['pj'=>$item,'state'=>'biodata','form_type'=>'only_edit']);
            return ;
        }



        if($act == 'biodata'){
            $state = $item->klien_id != 0 ? "biodata" : "init_biodata";

            $this->emit('openModal', 'staff-pelayanan-modal-call',['pj'=>$item,'state'=>$state]);
            return;
        }

        if ( $act == 'selesai' || $act == 'berjalan')
            $item->pelaksana_id = Auth::user()->id;

        $item->refs['status'] = $act;

        if($act == "selesai"){

            $this->dispatchBrowserEvent('taskCompleted');
        }

        $item->save();



        if ($act == 'panggil') {
            ($item->klien_id != null)
                ? $name = $item->pengunjung->name
                : $name = '';


            $loket_call = str_replace(' ', '', strtolower($this->loketAktif));
            $keys_call = str_replace('loket', '', $loket_call);
            $token_call =$item->refs['antrian'];
            $name_call = $name;
            $type = "call";

            //save call value on DB
            $dbCall = Config::where('title', $loket_call.'_call')->first();

            if(empty($dbCall)){
                Config::create([
                   'title'=> $loket_call.'_call',
                    'refs' => [
                        'token' => $token_call,
                        'pengunjung' => $name_call,
                        'tanggal'=>Carbon::now()->format('Y-m-d')
                    ]
                ]);
            }else{
                if ($dbCall->refs['token'] != $token_call) {
                    Config::where('title', $loket_call . '_call')->update([
                        'refs' => [
                            'token' => $token_call,
                            'pengunjung' => $name_call,
                            'tanggal'=>Carbon::now()->format('Y-m-d')
                        ]
                    ]);
                }
            }


            $this->emit('openModal', 'staff-pelayanan-modal-call',['pj'=>$item,'state'=>'call']);

        }

//        if($closeModal)
//            $this->forceClose()->closeModal();

        event(new QueuesService([
            'index' => (int)$keys_call,
            'token' => $token_call,
            'pid'=>$this->pid,
            'name' => $name_call,
            'loket' => $loket_call ?? "",
            'type'=>$type,
            //'call'=>$call,
            'cID'=>$item->id
        ]));
            DB::connection('mysql')->commit();
         }catch (Exception $e){

              DB::connection('mysql')->rollBack();

        }

    }

    public function getAktifLoket()
    {
        $aktif = Config::where('title', 'loket_aktif')->first()->refs;
        $loket = Config::where('title', 'loket_pelayanan')->first()->refs;
        $list = collect();


        foreach ($loket as $l) {
            $a = $aktif->where('nama', $l)->first();

            if ($a != null) {
                if ($a['tanggal'] != Carbon::now()->format('Y-m-d'))
                    $list->push($l);
            } else {
                $list->push($l);
            }
        }

        $list->push('Lepas Loket');

        //dd($list);

        $this->loketList = $list;
    }

    public function setAktifLoket($loket)
    {


        $row = Config::where('title', 'loket_aktif');

        if($loket == "Lepas Loket"){
            $aktif = $row->first()->refs->map(function($q) {
                if($q['pelaksana'] == Auth::user()->profile->refs['fullname']) {
                    $q['tanggal'] = '';
                    $q['pelaksana'] = '';
                    $q['pelayanan'] = '';
                    $q['noAntrianCall'] = '';
                    $q['namaAntrianCall'] = '';
                }
                return $q;
            });

            $row->update(['refs'=>$aktif]);
            $this->loketAktif  = null;
            return;
        }

        if ($this->loketAktif != null) {
            $aktif = $row->first()->refs->map(function($q) {
                if($q['nama'] == $this->loketAktif) {
                    $q['tanggal'] = '';
                    $q['pelaksana'] = '';
                    $q['pelayanan'] = '';
                    $q['noAntrianCall'] = '';
                    $q['namaAntrianCall'] = '';
                }
                return $q;
            });

            $row->update(['refs'=>$aktif]);
        }

        if ($row->first()->refs->contains('nama', $loket)) {
            $aktif = $row->first()->refs->map(function($q) use($loket) {
                if($q['nama'] == $loket) {
                    $q['tanggal'] = Carbon::now()->format('Y-m-d');
                    $q['pelaksana'] = Auth::user()->profile->refs['fullname'];
                    $q['pelayanan'] = $this->pelayanan->title;
                    $q['noAntrianCall'] = '';
                    $q['namaAntrianCall'] = '';
                }
                return $q;
            });
        } else {
            $aktif = $row->first()->refs->push([
                'nama' => $loket,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'pelaksana' => Auth::user()->profile->refs['fullname'],
                'pelayanan' => $this->pelayanan->title,
                'noAntrianCall' => '',
                'namaAntrianCall' => '',

            ]);
        }

        $row->update(['refs'=>$aktif]);
        $this->loketAktif = $loket;
    }

    public function setAktifPelayanan($id){
        //$this->pid = 3;
        return redirect(route('dashboard.pelayanan', ['id' => 2]));
    }

    public function goToCard($card){
        $this->dispatchBrowserEvent('gotocard', ['card' => $card]);
    }


}
