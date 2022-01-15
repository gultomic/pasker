<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Auth;

class Akun extends Component
{
    use WithPagination;

    public $paginate = 10 ;

    public function render()
    {
        return view('livewire.akun', [
            'collection' => User::latest()
                ->where('email', '!=', 'origin@example.com')
                ->where('id', '!=', Auth::user()->id)
                ->paginate($this->paginate)
        ]);
    }
}
