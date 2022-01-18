<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PelayananJadwal as PJ;
use App\Models\Config;
use App\Events\QueuesService;

class StafPelayanan extends Component
{
    public $pid;
    public $loketAktif = '...?';
    public $loketList;

    public function mount()
    {
        $this->loketList = Config::where('title', 'loket_pelayanan')->first()->refs;
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
}
