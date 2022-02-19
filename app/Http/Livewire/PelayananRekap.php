<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;

class PelayananRekap extends Component
{
    public $collection, $pelayanan;

    public function mount ($id)
    {
        $this->pelayanan = Pelayanan::find($id);

        $this->collection = PJ::has('survei')->where('pelayanan_id', $id)
            ->orderBy('tanggal')
            ->get()
            ->map(function ($q) {
                return [
                    'tanggal' => $q->tanggal,
                    'skor' => $q->survei->sum('skor'),
                ];
            });
    }

    public function render()
    {
        return view('livewire.pelayanan-rekap', [
            'barchart' => $this->collection->groupBy('tanggal'),
        ]);
    }
}
