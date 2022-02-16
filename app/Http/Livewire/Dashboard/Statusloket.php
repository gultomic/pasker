<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Config;
use Carbon\Carbon;

class Statusloket extends Component
{
    public function render ()
    {
        $data = Config::where('title', 'loket_pelayanan')->first()->refs;
        $aktifLoket = Config::where('title', 'loket_aktif')->first()->refs;
        $result = new Collection();

        foreach ($data as $loket) {
            $aktif = $aktifLoket
                ->where('nama', $loket)
                ->where('tanggal', Carbon::now()->format('Y-m-d'))
                ->first();

            ($aktif == null)
                ? $result->push([
                    'nama' => $loket,
                    'tangal' => '',
                    'pelaksana' => '',
                    'pelayanan' => ''
                ])
                : $result->push($aktif);
        }

        return view('livewire.dashboard.statusloket', [
            'collection' => $result,
        ]);
    }
}
