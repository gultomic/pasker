<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PelayananJadwal as PJ;

class StafPelayanan extends Component
{
    public $pid;

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
}
