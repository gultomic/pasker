<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Klien;

class Pengunjung extends Component
{
    use WithPagination;

    public $paginate = 10 ;
    public $search;

    public function render()
    {
        return view('livewire.pengunjung', [
            'collection' => Klien::latest()
                ->where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('phone', 'LIKE', "%{$this->search}%")
                ->orWhere('email', 'LIKE', "%{$this->search}%")
                ->paginate($this->paginate)
        ]);
    }

    public function updated()
    {
        $this->resetPage();
    }
}
