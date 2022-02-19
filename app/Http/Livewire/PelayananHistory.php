<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;

class PelayananHistory extends Component
{
    public $pid, $startDate, $endDate;
    public $collection;

    public function mount ($id)
    {
        $this->pid = $id;
    }

    public function render ()
    {
        $this->startDate == null
            ? $startDate = '1900-01-01'
            : $startDate = $this->startDate;

        $table = PJ::has('survei')->where('pelayanan_id', $this->pid)
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
                    'plid' => $q->first(),
                    'tanggal' => $q->first()['tanggal'],
                    'total' => $q->count(),
                    'skor' => $q->map(function ($r) {
                        return $r->survei->average('skor');
                    })
                    ->sum(),
                ];
            });

        return view('livewire.pelayanan-history', [
            'table' => $table,
        ]);
    }

    public function resetDate ()
    {
        $this->startDate = null;
        $this->endDate = null;
    }
}
