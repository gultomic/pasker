<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Klien;

class PengunjungShow extends Component
{
    public $row;

    protected $rules = [
        'row.name' => 'required|string|max:191',
        'row.phone' => 'required|unique:klien|numeric|max:15',
        'row.email' => 'required|unique:klien|max:191',
    ];

    public function mount ($rowid)
    {
        $this->row = Klien::find($rowid);
    }

    public function render()
    {
        return view('livewire.pengunjung-show', [
            'collection' => $this->row,
        ]);
    }

    public function store()
    {
        try {
            Klien::find($this->row->id)->update([
                'name'=>$this->row->name,
                'phone'=>$this->row->phone,
                'email'=>$this->row->email,
            ]);

            $this->emit('updatedRow');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
