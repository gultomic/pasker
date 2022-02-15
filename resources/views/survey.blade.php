@extends('layouts.bootstrap_public')
@section('content')

<div class="container-fluid hero-home pb-5"  x-data="survey"   >
    <div class="row mb-5">
        <div class="col-2 pt-4 mx-5">
            <img class="img-fluid" src="/assets/logo_light.png" alt="">
        </div>
    </div>
    <div class="row pt-2">

        <div class="col-lg-8 pb-5 mt-n4 text-center">
            <h1 class="head_grobold">Survey Kepuasan</h1>
            <p class="mb-5">Survey Kepuasan Pengunjung PASKER.ID</p>
            <div class="mt-3">
                <p>Pilih Pelayanan</p>
                <div class="row justify-content-center">
                @foreach ( $pelayanan as $item )
                    <div class="col col-lg-3 py-5 ml-3 mb-3 background-orange d-block survey-item-pelayanan"
                        @click="setdataSubmit({
                         pelayanan:'{{ $item->id }}',
                         pelayananKode:'{{ $item->refs['kode'] }}',
                         noAntrian:'',
                         })"
                         style="cursor:pointer;">
                        {{ $item->title }}
                    </div>
                @endforeach
                </div>
            </div>

            <div class="mt-3">
                <p>Masukkan No Antrian</p>
                <div class="row justify-content-center">
                    <div class="col col-lg-5">
                        <input x-model="noAntrianModel" type="text" class="form-control" id="noantrian" name="noantrian" autocomplete="off"
                               placeholder="Masukkan No Antrian, Misal 007"
                               required="true">
                    </div>
                </div>
            </div>

            <button type="button" id="startSurvey" class="btn btn-warning btn-lg mt-3 mb-3" @click="startSurvey()"
                    :disabled="isLoading ? true:false"
                    x-text=" !isLoading ? 'Submit' : 'Loading..'"
            >Submit</button>

        </div>

        <div class="col-lg-4 pb-4 text-right">
            <!-- <img class="position-absolute" style="bottom:0;right:0;" src="/assets/young-man.png" alt=""> -->
            <img class="img-fluid text-right" src="/assets/pose01_preview_small.png" alt="">
            <small class="text-left d-block" style="color: #eef9f6" x-text="nama">JOBI - Maskot Pasker.ID</small>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade modal-kiosk" id="survey-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-5">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-3 pb-5" style="font-size: 0.9rem;color:#212529 ">
                    <template x-if="dataResp">
                        <div id="modalkuesioner-container">
                            <div class="survey-state text-center" id="state-identity"
                                 x-show="surveyState == 'identitas'">
                                <h3>Hai, <span x-text="dataResp.pengunjung.name"></span></h3>
                                <p>Pastikan Identitas dibawah sudah benar sebelum mengisi survey</p>

                                <div class="text-left row justify-content-center ">
                                    <div class="col-lg-8">
                                        <div class="mb-1">
                                            <span class="d-inline-block" style="width: 40%">Nama:</span>
                                            <strong id="ident-nama" x-text="dataResp.pengunjung.name">Taufiq</strong>
                                        </div>
                                        <div class="mb-1">
                                        <span class="d-inline-block"
                                              style="width: 40%">No Handphone:</span>
                                            <strong id="ident-phone"
                                                    x-text="dataResp.pengunjung.phone">08123123123</strong>
                                        </div>
                                        <div class="mb-1"><span class="d-inline-block" style="width: 40%">Email:</span>
                                            <strong id="ident-email" x-text="dataResp.pengunjung.email">taufiq.ridha@gmail.com</strong>
                                        </div>
                                    </div>
                                </div>
                                <button class=" text-center btn btn-warning mt-4 btn-lg"
                                        @click="setSurveyStat('kuesioner')">Lanjut
                                </button>

                            </div>
                            <div class="survey-state text-center py-3" id=""
                                 x-show="surveyState == 'kuesioner'">

                                <template x-for="(question,indexQ) in dataResp.kuesioner" :key="question.id">
                                    <div x-show="statQindex === indexQ">
                                        <small class="text-uppercase d-block "
                                               x-text="`#Pertanyaan ${indexQ+1}`"></small>
                                        <h4 class="py-3" x-text="question.pertanyaan.pertanyaan">Pertanyaan</h4>
                                        <div class="py-3">
                                            <div class="row justify-content-center ">
                                                <template x-for="(answer,i) in question.pertanyaan.refs.opsi_jawaban"
                                                          :key="question.id+'_'+i">
                                                    <div
                                                        class="survey-item-jawaban col  ml-3 mb-3 background-orange py-3 cursor-pointer"
                                                        @click="gotoNextQuestion(dataResp.id,question.id,answer.skor)"
                                                        x-transition
                                                        x-transition.duration.500ms
                                                    >
                                                        <div class="display-4" x-html="answer.button"></div>
                                                        <div x-text="answer.nama"></div>
                                                    </div>

                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                </template>


                            </div>
                            <div class="survey-state text-center py-3" id=""
                                 x-show="surveyState == 'loadingSubmit'"
                                 x-transition
                                 x-transition.duration.1000ms
                            >
                                <h3>Loading</h3>
                                <p>Menyimpan data survey... mohon menunggu</p>


                            </div>
                        </div>

                    </template>
{{--                    <p x-text="surveyState"></p>--}}

                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->


</div>

@endsection

@push('alpine-script')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script>

        function survey() {
            return {
                noAntrianModel: "",
                surveyState:"",
                statQindex:0,
                isLoading: false,
                pjID:0,
                arrSurResult:[],
                dataSubmit: {
                    pelayanan: 0,
                    pelayananKode: '',
                },
                dataResp: null,
                setdataSubmit(data) {
                    this.dataSubmit = data
                    // console.log(this.dataSubmit)

                },
                startSurvey() {
                    if (this.dataSubmit.pelayanan == 0 || this.noAntrianModel == "") {
                        //return swal('Ups', 'Mohon pilih pelayanan dan isi no antrian terlebih dahulu', 'warning')
                    }
                    this.isLoading = true
                    this.dataSubmit.noAntrian = this.noAntrianModel;
                    console.log(this.dataSubmit)
                    this.dataSubmit = {
                        pelayanan: 1,
                        pelayananKode: "A",
                        noAntrian: '008'
                    };
                    axios.post('{{ route('survey.takeSurvey') }}', this.dataSubmit)
                    .then( (r)=>{
                            console.log(r.data.data);
                            // this.ok = true;
                            if (r.data.success == 1) {
                                this.dataResp = r.data.data
                                this.pjID = r.data.data.id
                                jQuery('#survey-modal').modal('show')
                                this.surveyState = "identitas"
                                console.log(this.pjID)
                            }else{

                                swal("Ups!", r.data.message, 'warning');
                            }

                        }).catch( (e)=>{
                            swal("Ups!", "Terjadi kesalahan silahkan ulangi", 'warning');
                            console.log(e);
                        }).then((e)=>{
                            this.isLoading = false;
                        })
                },
                gotoNextQuestion(PJID,kuesionerId,skor){
                    this.arrSurResult.push({
                        'jadwal_id':PJID,
                        'kuesioner_id':kuesionerId,
                        'skor':parseFloat(skor),
                    })

                  this.statQindex ++
                    if(this.statQindex>= this.dataResp.kuesioner.length){
                        this.submitSurvey()
                    }
                    console.log(this.arrSurResult)
                },
                submitSurvey(){
                    //todo: swall retry
                    this.surveyState = 'loadingSubmit'
                  axios.post('{{ route('survey.submitSurvey') }}', this.arrSurResult)
                    .then( (r)=>{
                            console.log(r.data.data);
                            // this.ok = true;
                            if (r.data.success == 1) {
                                //hide modal
                                jQuery('#survey-modal').modal('hide')
                                swal("Sukses","Berhasil menyimpan data survey. Terimakasih",'success')
                                this.surveyState=""
                                this.statQindex = 0
                            }else{
                                swal(r.data.message, {
                                    icon:"warning",
                                    title:"Ups!",
                                    buttons: {
                                        cancel: "Batal Simpan!",
                                        retry: {
                                            text: "Coba kembali",
                                            value: "retry",
                                        },
                                    },
                                })
                                    .then((value) => {
                                        switch (value) {
                                            case "retry":
                                                this.submitSurvey()
                                                break;

                                            default:
                                                alert('sfd')
                                                // jQuery('#survey-modal').modal('hide')
                                                //
                                                // this.surveyState=""
                                                // this.statQindex = 0

                                        }
                                    });

                            }

                        }).catch( (e)=>{
                            swal("Terjadi kesalahan silahkan ulangi", {
                                    icon:"warning",
                                    title:"Ups!",
                                    buttons: {
                                        cancel: "Batal Simpan!",
                                        retry: {
                                            text: "Coba kembali",
                                            value: "retry",
                                        },
                                    },
                                })
                                    .then((value) => {
                                        switch (value) {
                                            case "retry":
                                                this.submitSurvey()

                                            default:
                                                alert('sfd')
                                                // jQuery('#survey-modal').modal('hide')
                                                //
                                                // this.surveyState=""
                                                // this.statQindex = 0

                                        }
                                    });

                            console.log(e);
                        }).then((e)=>{

                        })
                },
                setSurveyStat(action){
                    this.surveyState = action
                }
            }
        }

    </script>
@endpush


@push('script')

<script>

    $('.survey-item-pelayanan').on('click',function(){
            $('.survey-item-pelayanan').removeClass('active')
            $(this).addClass('active');

    })





</script>

@endpush




@section('footer')
    <footer>
        <div class="container container-footer">
            <div class="pt-4 mb-4 pt-md-5 border-top">
                <div class="row mb-3">
                    <div class="col-6 col-md">
                        <img class="mb-2" src="/assets/logo_blue.png" alt="" width="200">
                        <div class="link-site pl-3 mt-3">
                            <a class="d-block mb-2" href="https://kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>Kemnaker.go.id</u></a>
                            <a class="d-block" href="https://karirhub.kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>#KARIRhub</u></a>
                        </div>


                    </div>
                    <div class="col-6 col-md text-secondary">
                        <h5 class="text-pasker poppinsmedium">Pasker.ID</h5>
                        <p class="text-orange-pasker-light" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
                        <p>
                            Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                        </p>
                        <div class="row">
                            <div class="col-md-7">
                                <i class="bi bi-telephone text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;1500630<br/>
                                <i class="bi bi-envelope text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;pasker@kemenaker.go.id
                            </div>
                            <div class="col-md-5 text-right">
                                <div class="footer-social" style="font-size: 1.4rem">
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-twitter"></i></a>
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-facebook"></i></a>
                                    <a target="_blank" class="ml-3 d-inline-block text-pasker" href="https://www.instagram.com/pusatpasarkerja/"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </footer>
@endsection



