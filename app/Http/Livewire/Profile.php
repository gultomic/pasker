<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithfileUploads;
use App\Models\User;
use Auth;
use Hash;

class Profile extends Component
{
    use WithFileUploads;

    public $rowid, $email, $photo, $fullname, $username, $phone, $display;
    public $passwordNew, $passwordConfirm;
    public $savePhoto = 'hidden';

    protected $rules = [
        'username' => 'required',
        'email' => 'required',
        'fullname' => 'required',
    ];

    public function mount()
    {
        $row = User::with('profile')->where('id', Auth::user()->id)->first();
        $this->rowid = $row->id;
        $this->fullname = $row->profile->refs['fullname'];
        $this->photo = $row->profile->refs['photo'];
        $this->display = $row->profile->refs['photo'];
        $this->username = $row->username;
        $this->email = $row->email;
        $this->phone = $row->phone;
    }

    public function render ()
    {
        return view('livewire.profile');
    }

    public function store ($col)
    {
        $row = User::find($this->rowid);

        if ($col == 'phone') {
            $this->validate([
                'phone' => 'unique:users|digits_between:10,15',
            ]);

            $row->phone = $this->phone;
            $row->save();
        }

        if ($col == 'fullname') {
            $this->validate([
                'fullname' => 'required',
            ]);

            $row->profile()->refs['fullname'] = $this->fullname;
            $row->profile()->update([
                'refs->fullname' => $this->fullname,
            ]);
        }

        if ($col == 'photo') {
            $this->validate([
                'photo' => 'image|max:1024',
            ]);

            $name = md5($this->photo . microtime()).'.'.$this->photo->extension();
            $this->photo->storeAs('uploads', $name);
            $this->photo = "/uploads/$name";

            $row->profile()->refs['photo'] = $this->photo;
            $row->profile()->update([
                'refs->photo' => $this->photo,
            ]);
            $this->savePhoto = 'hidden';
        }

        if ($col = 'password') {
            $this->validate([
                'passwordNew' => 'required|string|min:8', // !need mixed case
                'passwordConfirm' => 'required|same:passwordNew',
            ]);

            try {
                $row->password = Hash::make($this->passwordNew);
                $row->save();
                session()->flash('message', 'Password changed, attempt to logout.');
            } catch (\Throwable $th) {
                //throw $th;
            }

            Auth::logout();
            return redirect()->to('/login');
        }
    }

    public function updatedPhoto ()
    {
        $this->display = $this->photo->temporaryUrl();
        $this->savePhoto = '';
    }

    public function updated ($propertyName)
    {
        $this->validateOnly($propertyName, [
            'passwordNew' => 'required|string|min:8', // !need mixed case
            'passwordConfirm' => 'required|same:passwordNew',
        ]);
    }
}
