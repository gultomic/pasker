@extends('layouts.bootstrap_public')
@section('content')

        <div x-data="dataD()" x-init="mounted()" class="mt-16 xxl:mt-0 xxl:ml-auto">
        <h4 class="font-bold text-lg">Axios example with Alpine js</h4>
        <p>in this example we are using https://reqres.in</p>

            <div style="height:25px;" class="mt-6">
                <p x-show.transition="ok" style="display: none;" class="bg-blue-500 text-white rounded inline py-1 px-2">updated!</p>
            </div>

            <div class="mt-4">
                <label><input x-model="dato1" x-bind:checked="dato1" @click="inviaValoriCheckBox(dato1)"  type="checkbox" class="border border-1">
                    axios get https://reqres.in/api/unknown/2
                </label>
            </div>

            <p x-show.transition="axiosResponse" x-text="axiosResponse"></p>

    </div>
@endsection
@push('alpine-script')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
function dataD(){
           return {
                dato1: '',
                axiosResponse: '',
                ok: false,

                inviaValoriCheckBox(val, servizio){
                    axios.get( 'https://reqres.in/api/unknown/2')
                    .then( (r)=>{
                            console.log(r.data.data);
                            this.ok = true;
                            this.axiosResponse = r.data.data.name;
                            setTimeout(() => {
                                this.ok = false;
                            }, 5000);

                        }).catch( (e)=>{
                            console.log(e);
                        })
                },
                mounted(){
                    console.log('mounted');
                }
           }
       }

</script>
@endpush
