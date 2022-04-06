<?php

namespace App\Http\Livewire;

use App\Models\Klien;
use Illuminate\Validation\Rule;

use LivewireUI\Modal\ModalComponent;
use App\Models\PelayananJadwal as PJ;

class StaffPelayananModalCall extends ModalComponent
{
    public PJ $data;

    public $state;
    public $name, $email, $phone,$klienID,$formType;

    public function mount(PJ $pj, $state,$form_type=null)
    {
        $this->data = $pj;
        $this->state = $state;

        $this->name = $this->data->pengunjung ? $this->data->pengunjung->name : "";
        $this->phone = $this->data->pengunjung ? $this->data->pengunjung->phone : "";
        $this->email = $this->data->pengunjung ? $this->data->pengunjung->email : "";
        $this->klienID = $this->data->pengunjung ? $this->data->pengunjung->id : "";
        $this->formType = $form_type;
        $this->clientIsNew = false;


    }
    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return '4xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }


    public static function closeModalOnClickAway(): bool
    {

        return false;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }


    public function setActionModal($item,$act){

        if($act == "biodata"){
            $this->state = "biodata";
            $this->emit('setActions',$item,'berjalan');
        }else{
            $this->emit('setActions',$item,$act);
            if($act!="panggil"){
                $this->closeModal();
            }
        }

    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'email.unique' => 'Email sudah pernah ada. Silahkan gunakan yang lain',
            'email.email' => 'Format email salah',
            'phone.required' => 'No Handphone wajib diisi',
            'phone.unique' => 'Handphone sudah pernah ada. Silahkan gunakan yang lain',
            'phone.regex' => 'Format No Handphone salah dan harus dimulai dengan angka 0',
        ];
    }

    public function store(){

        $this->validate([
            'name' => 'required|min:4',
            'email' => [
                'email',
                'nullable',
                Rule::unique('klien')->ignore($this->klienID),
            ],
            'phone' => [
                'required',
                Rule::unique('klien')->ignore($this->klienID),
                'regex:/^[0][0-9]{4,}/'
            ],
        ]);

        ($this->klienID != '')
            ? $row = Klien::find($this->klienID)
            : $row = new Klien();

        $row->name = $this->name;
        $row->phone = $this->phone;
        if($this->email == ""){
            $row->email = null;
        }else{
            $row->email = $this->email;
        }


        $row->save();
        $this->klienID = $row->id;

        $rowPJ = PJ::find($this->data->id);
        $rowPJ->klien_id = $row->id;
        $rowPJ->save();

        if($this->formType == "only_edit"){
            $this->emit('refreshList');
            return $this->emit('closeModal');

        }

        $this->emit('setActions',$rowPJ->id,'berjalan');

        $this->data = $rowPJ;

        $this->state ='onserving';

    }

    public function search(){

        $this->validate([
            'phone' => [
                'required',
                'regex:/^[0][0-9]{4,}/'
            ],
        ]);

        $klien = Klien::where('phone',$this->phone)->first();
        $this->name = "";
        $this->email = "";
        if(empty($klien)){
            $this->clientIsNew = true;
            $this->state = "init_biodata";
        }

        if(!empty($klien)){
            $this->name = $klien->name ;
            $this->email = $klien->email;
            $this->state = "biodata";
            $this->klienID = $klien->id;
        }


    }

    public function setState($dataID,$act){
        $this->state = $act;
        if($act == 'biodata'){
            $this->clientIsNew = false;
            $this->data = PJ::find($dataID);
        }
    }

    public function setBiodataBaru($dataId){
         $this->state = "init_biodata";
         $this->data = PJ::find($dataId);
    }

    public function render()
    {



        return view('livewire.staff-pelayanan-modal-call');
    }
}
