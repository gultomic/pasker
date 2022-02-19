<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;
use Auth;

class StafPelayananHistory extends Component
{
    public $startDate, $endDate;

    public function render ()
    {
        $this->startDate == null
            ? $startDate = '1900-01-01'
            : $startDate = $this->startDate;

        $bydate = $this->totalCollection()
            ->whereBetween('tanggal', [
                Carbon::parse($startDate)->format('Y-m-d'),
                Carbon::parse($this->endDate)->format('Y-m-d')
            ])
            ->groupBy('tanggal')
            ->map(function($q, $k) {
                return [
                    'tanggal' => $k,
                    'total' => $q->count(),
                    'skor' => $q->sum('skor')
                ];
            });

        return view('livewire.staf-pelayanan-history', [
            'bydate' => collect($bydate)->values(),
        ]);
    }

    public function resetDate ()
    {
        $this->startDate = null;
        $this->endDate = null;
    }

    private function totalCollection ()
    {
        return Auth::user()
            ->historyPelayanan()
            ->orderBy('tanggal')
            ->get()
            ->map(function($q) {
                return [
                    'id' => $q->id,
                    'pelayanan' => $q->pelayanan->title,
                    'skor' => $q->survei->average('skor'),
                    'tanggal' => $q->tanggal,
                ];
            });
    }
}
