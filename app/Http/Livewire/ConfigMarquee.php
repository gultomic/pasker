<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Config;

class ConfigMarquee extends Component
{
    public $row, $text;
    public $idx = null;

    public function mount ()
    {
        $this->row = Config::where('title', 'list_marquee')->first()->refs;
    }

    public function render ()
    {
        return view('livewire.config-marquee');
    }

    public function store ()
    {
        if ($this->idx == null) {
            $this->row->push($this->text);
        } else {
            $this->row[$this->idx] = $this->text;
            $this->idx = null;
        }

        $row = Config::where('title', 'list_marquee');
        $row->update(['refs' => $this->row->values()]);
        $this->text = '';
    }

    public function show ($idx)
    {
        $this->idx = $idx;
        $this->text = $this->row[$idx];
    }

    public function remove ($idx)
    {
        $this->row->forget($idx);
        $row = Config::where('title', 'list_marquee');
        $row->update(['refs' => $this->row->values()]);
    }
}
