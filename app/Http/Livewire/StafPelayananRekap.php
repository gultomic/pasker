<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;
use Auth;

class StafPelayananRekap extends Component
{
    public function render()
    {
        return view('livewire.staf-pelayanan-rekap', [
            'collection' => $this->totalCollection()->groupBy('pelayanan'),
            'byweek' => $this->totalCollection()
                ->groupBy(function($q) {
                    return Carbon::parse($q['tanggal'])->format('Y-W');
                })
                ->map(function($q) {
                    return [
                        'total' => $q->count(),
                        'skor' => $q->sum('skor'),
                        'indeks' => (($q->sum('skor') / 3) / $q->count()) * 100
                    ];
                }),
        ]);
    }

    private function totalCollection ()
    {
        return Auth::user()
            ->historyPelayanan()
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
