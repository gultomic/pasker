<?php

//todo: validate if client already taken survey

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Klien;
use App\Models\Survei;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{

    public function landing(Request $request)
    {

        return view('survey', [
            'pelayanan'=>Pelayanan::latest()
//            ->where('refs->aktif', '=', true)
            ->get()
        ]);

    }

    public function takeSurvey(Request $request){
        //find is taken PJ
        $today = Carbon::now()->format('Y-m-d');
        $isPJTaken = PJ::where([
            'pelayanan_id'=>$request->pelayanan,
            'refs->antrian'=> $request->pelayananKode . $request->noAntrian,
            'refs->status'=> 'selesai',
            'tanggal'=> $today
        ])->whereHas('pengunjung')
            ->with('pengunjung')
            ->first();

        if(!$isPJTaken){
            return response()->json([
                'success'=>0,
                'message'=>"Pengunjung Tidak ditemukan",

            ]);
        }

        //find kuesioner
        $kuesioner = Kuesioner::where([
            'pelayanan_id'=>$isPJTaken->pelayanan_id,
            'hide'=>0
        ])
            ->whereHas('pertanyaan')
            ->with('pertanyaan')
            ->orderBy('nomor')
            ->get();

        //todo: validate if already taken
        //todo: validate pertanyaan exist

        if(count($kuesioner)<=0 ){
            return response()->json([
                'success'=>0,
                'message'=>"Kuesioner belum ada, silahkan hubungi Admin",
            ]);
        }

        //find taken survei
        $survei_taken = Survei::where([
            'jadwal_id'=>$isPJTaken->id,
            'kuesioner_id'=>$kuesioner[0]->id
        ])->first();

        if($survei_taken){
            return response()->json([
                'success'=>0,
                'message'=>"Data survey sudah pernah ada, tidak dapat ditambahkan kembali"
            ]);
        }

        $data = $isPJTaken;
        $data['kuesioner'] = $kuesioner;
//        $data['pengunjung'] = $isPJTaken->pengunjung;

        return response()->json([
            'success'=>1,
            'data'=>$data
        ]);

    }

    public function submitSurvey(Request $request){
        $data = $request->json()->all();

        $taken = Survei::where('jadwal_id',$data[0]['jadwal_id'])->first();
        if($taken){
            return response()->json([
                'success'=>0,
                'message'=>"Data survey sudah pernah ada, tidak dapat ditambahkan kembali"
            ]);
        }
        DB::table('survei')->insert($request->json()->all());


        return response()->json([
            'success'=>1,


        ]);
    }


}
