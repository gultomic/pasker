<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelayanan as PE;

class Pelayanan extends Component
{
    use WithPagination;

    public $paginate = 10 ;
    public $rowId, $title, $kode, $antrian, $deskripsi, $aktif = true;

    public function render()
    {
        return view('livewire.pelayanan', [
            'collection' => PE::latest()->paginate($this->paginate)
        ]);
    }

    public function store()
    {
        ($this->rowId != '')
            ? $row = PE::find($this->rowId)
            : $row = new PE();

        $row->title = $this->title;
        $row->refs = [
            'kode' => $this->kode,
            'antrian' => $this->antrian,
            'deskripsi' => $this->deskripsi,
            'aktif' => $this->aktif,
        ];

        $row->save();
    }

    public function show($id)
    {
        if($id != '') {
            $row = PE::find($id);
            $this->rowId = $id;
            $this->title = $row->title;
            $this->kode = $row->refs['kode'];
            $this->antrian = $row->refs['antrian'];
            $this->deskripsi = $row->refs['deskripsi'];
            $this->aktif = $row->refs['aktif'];
        } else {
            $this->rowId = '';
            $this->title = '';
            $this->kode = '';
            $this->antrian = '';
            $this->deskripsi = '';
            $this->aktif = true;
        }
    }
}
