<?php


namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Klien;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Auth;
use Carbon\Carbon;

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

        $data = $isPJTaken;
        $data['kuesioner'] = $kuesioner;
//        $data['pengunjung'] = $isPJTaken->pengunjung;

        return response()->json([
            'success'=>1,
            'data'=>$data
        ]);

    }


}
