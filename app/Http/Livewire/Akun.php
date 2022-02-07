<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Auth;
use Hash;

class Akun extends Component
{
    use WithPagination;

    public $search, $paginate = 10 ;
    public $fullname, $email, $username, $phone, $role = 'staf', $access = true;

    protected $rules = [
        'email' => 'required|email:rfc,dns|unique:users|max:100',
        'username' => 'required|unique:users|min:5|max:20',
        'fullname' => 'required',
        'phone' => 'required',
        'role' => 'required|numeric|min:10',
    ];

    public function render()
    {
        $search = $this->search;
        $origin = User::where('email', 'origin@example.com')->first();
        $collection = User::latest()
            ->whereNotIn('id', [Auth::user()->id, $origin->id])
            ->where(function ($q) {
                $q
                    ->where('username', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%")
                    ->orWhereHas('profile', function ($p) {
                        $search = strtolower($this->search);
                        $p->whereRaw('LOWER(`refs`) LIKE ?', "%{$search}%");
                    });
            });

        return view('livewire.akun', [
            'collection' => $collection->paginate($this->paginate)
        ]);
    }

    public function store ()
    {
        try {
            $row = User::create([
                'email' => $this->email,
                'username' => $this->username,
                'phone' => $this->phone,
                'access' => $this->access,
                'password' => Hash::make('login123'),
            ]);

            $row->profile()->create([
                'refs' => [
                    'fullname' => $this->fullname,
                    'photo' => '/assets/image.png'
                ]
            ]);

            $row->role()->create([
                'level' => $this->role,
            ]);

            $this->resetForm();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function setAccess($id)
    {
        $row = User::find($id);

        ($row->access)
            ? $row->access = false
            : $row->access = true;

        $row->save();
    }

    public function resetForm ()
    {
        $this->fullname = '';
        $this->email = '';
        $this->username = '';
        $this->phone = '';
        $this->access = true;
        $this->role = 'staf';
    }
}
