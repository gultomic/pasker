<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatPelayanan;

class PelayananHistory extends Component
{
    public $pid, $startDate, $endDate;
    public $collection, $pelayanan;

    public function mount ($id)
    {
        $this->pid = $id;
        $this->pelayanan = Pelayanan::find($id);
    }

    public function render ()
    {
        $this->startDate == null
            ? $startDate = '2020-01-01'
            : $startDate = $this->startDate;

        $this->collection = PJ::has('survei')->where('pelayanan_id', $this->pid)
            ->whereBetween('tanggal', [
                Carbon::parse($startDate)->format('Y-m-d'),
                Carbon::parse($this->endDate)->format('Y-m-d')
            ])
            ->orderBy('tanggal')
            ->get()
            ->groupBy('tanggal')
            ->values()
            ->map(function($q) {
                return [
                    'tanggal' => $q->first()['tanggal'],
                    'total' => $q->count(),
                    'skor' => $q->map(function ($r) {
                        return $r->survei->average('skor');
                    })
                    ->sum(),
                ];
            });

        return view('livewire.pelayanan-history', [
            'table' => $this->collection,
        ]);
    }

    public function resetDate ()
    {
        $this->startDate = null;
        $this->endDate = null;
    }

    public function export ()
    {
        $title = str_replace(" ","_",strtolower($this->pelayanan->title));
        $time = Carbon::now()->format('Ymd-His');

        return Excel::download(
            new RiwayatPelayanan($this->collection, $this->pelayanan->title),
            $title."_".$time.".xlsx"
        );
    }
}
