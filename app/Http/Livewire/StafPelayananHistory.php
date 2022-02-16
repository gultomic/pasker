<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PelayananJadwal as PJ;
use Carbon\Carbon;
use Auth;

class StafPelayananHistory extends Component
{
    use WithPagination;

    public $paginate = 10;

    public function render ()
    {
        $bydate = $this->totalCollection()
            ->groupBy('tanggal')
            ->map(function($q, $k) {
                return [
                    'tanggal' => $k,
                    'total' => $q->count(),
                    'skor' => $q->sum('skor')
                ];
            });

        return view('livewire.staf-pelayanan-history', [
            'collection' => $this->totalCollection()->groupBy('pelayanan'),
            'bydate' => collect($bydate)->values(),
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
