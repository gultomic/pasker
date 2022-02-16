<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kuesioner as Kue;
use App\Models\Pertanyaan;

class Kuesioner extends Component
{
    use WithPagination;

    public $paginate = 5 ;
    public $rowId, $pelayanan, $nomor, $pertanyaan;

    public function render()
    {
        $kue = Kue::where('pelayanan_id', $this->pelayanan)
            ->orderBy('nomor');
        // $pluck = $kue->pluck('pertanyaan_id');

        return view('livewire.kuesioner', [
            'collection' => $kue->paginate(),
            'question' => Pertanyaan::latest()->get()
        ]);
    }

    public function store ()
    {
        ($this->rowId != '')
            ? $row = Kue::find($this->rowId)
            : $row = new Kue();

        $row->pertanyaan_id = $this->pertanyaan;
        $row->nomor = $this->nomor;
        $row->pelayanan_id = $this->pelayanan;

        $row->save();
        $this->resetForm();
        $this->resetPage();
    }

    public function show ($id)
    {
        $row = Kue::find($id);
        $this->rowId = $id;
        $this->nomor = $row->nomor;
        $this->pelayanan = $row->pelayanan_id;
        $this->pertanyaan = $row->pertanyaan_id;
    }

    public function resetForm ()
    {
        $this->nomor = '';
        $this->pertanyaan = '';
    }
}
