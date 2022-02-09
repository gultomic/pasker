<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Config;

class ConfigLoket extends Component
{
    public $row;

    public function render()
    {
        return view('livewire.config-loket', [
            'collection' => Config::where('title', 'loket_pelayanan')->first()->refs,
        ]);
    }
}
