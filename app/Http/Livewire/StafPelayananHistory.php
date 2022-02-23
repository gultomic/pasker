<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatPelayanan;
use Auth;

class StafPelayananHistory extends Component
{
    public $collection, $startDate, $endDate;

    public function render ()
    {
        $this->startDate == null
            ? $startDate = '2020-01-01'
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

        $this->collection = collect($bydate)->values();

        return view('livewire.staf-pelayanan-history', [
            'bydate' => $this->collection,
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

    public function export ()
    {
        $title = str_replace(" ","_",strtolower(Auth::user()->profile->refs['fullname']));
        $time = Carbon::now()->format('Ymd-His');

        return Excel::download(
            new RiwayatPelayanan($this->collection, Auth::user()->profile->refs['fullname']),
            $title."_".$time.".xlsx"
        );
    }
}
