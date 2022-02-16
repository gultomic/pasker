<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $email, $photo, $fullname, $username, $phone;

    protected $rules = [
        'username' => 'required',
        'email' => 'required',
        'fullname' => 'required',
    ];

    public function mount($uname)
    {
        $row = User::with('profile')->where('username', $uname)->first();
        $this->fullname = $row->profile->refs['fullname'];
        $this->photo = $row->profile->refs['photo'];
        $this->username = $row->username;
        $this->email = $row->email;
        $this->phone = $row->phone;
    }

    public function render ()
    {
        return view('livewire.profile');
    }

    public function store ()
    {}
}
