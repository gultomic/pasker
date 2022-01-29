<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pertanyaan as Que;

class Pertanyaan extends Component
{
    use WithPagination;

    public $paginate = 5 ;
    public $rowId, $pertanyaan;

    public function render()
    {
        return view('livewire.pertanyaan', [
            'collection' => Que::latest()
                ->paginate($this->paginate)
        ]);
    }

    public function store ()
    {
        ($this->rowId != '')
            ? $row = Que::find($this->rowId)
            : $row = new Que();

        $row->pertanyaan = $this->pertanyaan;
        $row->refs = [
            'metode_jawaban' => '3 poin',
            'opsi_jawaban' => [
                [
                    'skor' => 1,
                    'nama' => 'tidak puas',
                    'button' => '<i class="far fa-frown"></i>'
                ],
                [
                    'skor' => 2,
                    'nama' => 'puas',
                    'button' => '<i class="far fa-smile"></i>'
                ],
                [
                    'skor' => 3,
                    'nama' => 'sangat puas',
                    'button' => '<i class="far fa-laugh"></i>'
                ],
            ]
        ];

        $row->save();
        $this->resetForm();
        $this->resetPage();
    }

    public function show ($id)
    {
        $row = Que::find($id);
        $this->rowId = $id;
        $this->pertanyaan = $row->pertanyaan;
    }

    public function resetForm ()
    {
        $this->rowId = '';
        $this->pertanyaan = '';
    }
}
