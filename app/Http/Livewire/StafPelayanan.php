<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PelayananJadwal as PJ;
use App\Models\Config;
use App\Events\QueuesService;
use Auth;

class StafPelayanan extends Component
{
    public $pid;
    public $loketAktif = null;
    public $loketList = [];
    public $pelayanan;

    public function mount()
    {
        $this->pelayanan = \App\Models\Pelayanan::find($this->pid);
        // $this->loketList = Config::where('title', 'loket_pelayanan')->first()->refs;
    }

    public function render()
    {
        $date = Carbon::now()->format('Y-m-d');

        return view('livewire.staf-pelayanan', [
            'collection' => PJ::where('pelayanan_id', $this->pid)
                ->where('tanggal', '=', $date)
                ->where('refs->antrian', '!=', "")
                ->orderBy("refs->antrian")
                ->get(),
            'date' => $date,
        ]);
    }

    public function setAction($id, $act)
    {
        $item = PJ::find($id);
        $item->refs['status'] = $act;
        $item->save();

        if($act == 'panggil') {
            ($item->klien_id != null)
                ? $name = $item->pengunjung->name
                : $name = '---';

            $keys = array_keys($this->loketList->toArray(), $this->loketAktif);

            event(new QueuesService([
                'index' => $keys[0],
                'token' => $item->refs['antrian'],
                'name' => $name,
            ]));
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

        $this->loketList = $list;
    }

    public function setAktifLoket($loket)
    {
        $row = Config::where('title', 'loket_aktif');
        if ($this->loketAktif != null) {
            $aktif = $row->first()->refs->map(function($q) {
                if($q['nama'] == $this->loketAktif) {
                    $q['tanggal'] = '';
                    $q['pelaksana'] = '';
                    $q['pelayanan'] = '';
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
                }
                return $q;
            });
        } else {
            $aktif = $row->first()->refs->push([
                'nama' => $loket,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'pelaksana' => Auth::user()->profile->refs['fullname'],
                'pelayanan' => $this->pelayanan->title,
            ]);
        }

        $row->update(['refs'=>$aktif]);
        $this->loketAktif = $loket;
    }
}
