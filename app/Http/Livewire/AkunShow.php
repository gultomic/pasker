<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class AkunShow extends Component
{
    public $row;

    public function mount($id)
    {
        $this->row = User::find($id);
    }

    public function render()
    {
        $pelayanan = $this->row->historyPelayanan;
        return view('livewire.akun-show', [
            'collection' => $pelayanan->groupBy('pelayanan_id')
                ->map(function ($q) {
                    $first = $q->first()->pelayanan;
                    $survei = $q->map(function ($m) {
                        return $m->survei->average('skor');
                    })->sum();
                    $indeks = (($survei / 3) / $q->count()) * 100;

                    return [
                        'id' => $first->id,
                        'title' => $first->title,
                        'total' => $q->count(),
                        'skor' => $survei,
                        'indeks' => number_format($indeks, 2)
                    ]
                    ;
                }),
        ]);
    }
}
