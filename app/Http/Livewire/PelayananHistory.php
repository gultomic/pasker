<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;

class PelayananHistory extends Component
{
    use WithPagination;

    public $paginate = 5;
    public $pid;

    public function mount ($id)
    {
        $this->pid = $id;
    }

    public function render()
    {
        $pelayanan = Pelayanan::find($this->pid);
        $collection = PJ::has('survei')->where('pelayanan_id', $this->pid)
            ->get()
            ->map(function ($q) {
                return [
                    'tanggal' => $q->tanggal,
                    'skor' => $q->survei->sum('skor'),
                ];
            });

        return view('livewire.pelayanan-history', [
            'pelayanan' => $pelayanan,
            'skoring' => $collection,
            'collection' => $collection
        ]);
    }
}
