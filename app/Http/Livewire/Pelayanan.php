<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelayanan as PE;

class Pelayanan extends Component
{
    use WithPagination;

    public $paginate = 10 ;

    public function render()
    {
        return view('livewire.pelayanan', [
            'collection' => PE::latest()->paginate($this->paginate)
        ]);
    }
}
