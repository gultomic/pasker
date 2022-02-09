<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Pelayanan;

class Statuslayanan extends Component
{
    public function render()
    {
        return view('livewire.dashboard.statuslayanan', [
            'collection' => Pelayanan::latest()->where('refs->aktif', '=', true)->get(),
        ]);
    }
}
