<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Auth;

class StafPelayananHistory extends Component
{
    public function render()
    {
        return view('livewire.staf-pelayanan-history', [
            'collection' => Auth::user()
                ->historyPelayanan()
                ->join('pelayanan', 'pelayanan_jadwal.pelayanan_id', '=', 'pelayanan.id')
                ->select('pelayanan_jadwal.*', 'pelayanan.title')
                ->latest()
                ->get()
                ->groupBy('title')
        ]);
    }
}
