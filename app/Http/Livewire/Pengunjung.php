<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Klien;

class Pengunjung extends Component
{
    use WithPagination;

    public $paginate = 10 ;

    public function render()
    {
        return view('livewire.pengunjung', [
            'collection' => Klien::latest()->paginate($this->paginate)
        ]);
    }

    public function store()
    {}
}
