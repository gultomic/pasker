<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Config;
use Carbon\Carbon;

class ConfigJamoperasional extends Component
{
    public $row;

    protected $rules = [
        'row.*.kuota_per_jam' => 'required',
        'row.*.jam_buka' => 'required',
        'row.*.jam_tutup' => 'required',
        'row.*.libur' => 'required',
    ];

    public function mount ()
    {
        $this->row = Config::where('title', 'loket_jam')->first()->refs;
    }

    public function render ()
    {
        return view('livewire.config-jamoperasional');
    }

    public function store ()
    {
        $row = Config::where('title', 'loket_jam');
        $row->update(['refs' => $this->row]);
    }
}
