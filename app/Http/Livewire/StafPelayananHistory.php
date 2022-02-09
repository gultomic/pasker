<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Auth;

class StafPelayananHistory extends Component
{
    public function render()
    {
        $collection = Auth::user()
        ->historyPelayanan()
        ->get()
        ->map(function($q) {
            return [
                'id' => $q->id,
                'pelayanan' => $q->pelayanan->title,
                'skor' => $q->survei->average('skor'),
                'tanggal' => $q->tanggal,
            ];
        })
        ;
        // dd($collection);
        return view('livewire.staf-pelayanan-history', [
            'collection' => $collection,
        ]);
    }
}
