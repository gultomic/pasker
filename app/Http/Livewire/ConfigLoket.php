<?php

namespace App\Http\Livewire;

use App\Events\QueuesService;
use Livewire\Component;
use App\Models\Config;

class ConfigLoket extends Component
{
    public $row;

    public function mount ()
    {
        $this->row = Config::where('title', 'loket_pelayanan')->first()->refs;
    }

    public function render()
    {
        return view('livewire.config-loket');
    }

    public function store ()
    {
        $length = count($this->row) + 1;
        $this->row->push("Loket $length");

        $row = Config::where('title', 'loket_pelayanan');
        $row->update(['refs'=>$this->row]);

        $this->sendEventTosignage();
    }

    public function remove ()
    {
        $this->row->pop();
        $row = Config::where('title', 'loket_pelayanan');
        $row->update(['refs'=>$this->row]);
        $this->sendEventTosignage();
    }

    private function sendEventTosignage(){
        event(new QueuesService([
            'type' => 'loketList',
            'pid'=>1,
            'newData'=>Config::where('title', 'loket_pelayanan')->first()->refs
        ]));
    }
}
