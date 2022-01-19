<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Auth;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function online_submit(Request $request)
    {
        //todo validate

        //find by id
        $sel_pelayanan = Pelayanan::find($request->pelayanan);

        //todo: validate pelayanan exist and active
        //todo: validate submission with same klien within same date

        //check klien if exist
        $ex_klien = Klien::where('phone', $request->phone)->first();
        //$klienId = $ex_klien->id;

        if (empty($ex_klien)) {
            $newKlien = new Klien();
            $newKlien->name =  $request->nama;
            $newKlien->phone =  $request->phone;

            if (empty($request->email)) {
                $request->email = "";
            }

            $newKlien->email =  $request->email;

            $newKlien->save();
            $klienId = $newKlien->id;
        }else{
            $klienId = $ex_klien->id;
        }


        $newPJ = new PJ();
        $newPJ->klien_id = $klienId;
        $newPJ->pelayanan_id = $sel_pelayanan->id;
        
        $newPJ->tanggal = Carbon::now()->format('Y-m-d');
        $newPJ->refs = ['antrian' => '','daftar'=>'online'];
        $newPJ->save();

        //return redirect(route('registration.online.success'))->with('name', $request->nama);
        return redirect(route('registration.online.success'));

    }

    public function kiosk_submit_phone(Request $request)
    {
        //found klien first
        $klien = Klien::where('phone',$request->phone)->first();
        $date = Carbon::now()->format('Y-m-d');

        if(empty($klien)){
            return response()->json([
                'success' => 0,
            ]);
        }
        
        // then check booking date is today
        $booking_data = PJ::where('klien_id',$klien->id)
        ->where('tanggal', '=', $date)
        ->where('refs->antrian', '=', "")
        ->first();

        if(empty($booking_data)){
            return response()->json([
                'success' => 0,
            ]);
        }

        //find bookingdata and create antrian
        //todo : check if pelayanan exist
        $pelayanan = Pelayanan::find($booking_data->pelayanan_id);

        //gettotal pelayananid today, and crate incr number

        $cont_serve_pelayanan= PJ::where('pelayanan_id',$pelayanan->id)
        ->where('tanggal', '=', $date)
        ->where('refs->antrian', '!=', "")
        ->count();

        $no_antrian  = $pelayanan->refs['kode'].''.($cont_serve_pelayanan+1);

        //update booking data
        $booking_data->refs['antrian'] = $no_antrian;
        $booking_data->refs['status'] = "menunggu";
        $booking_data->save();

        
        
        return response()->json([
            'success' => 1,
            'data' => $booking_data,
            'noAntrian'=>$no_antrian
            // 'data'=>$data
        ]);

    }

    public function kiosk_submit(Request $request)
    {
        

        $date = Carbon::now()->format('Y-m-d');
        
        //find bookingdata and create antrian
        //todo : check if pelayanan exist
        $pelayanan = Pelayanan::find($request->pelayanan_id);

        //gettotal pelayananid today, and crate incr number

        $cont_serve_pelayanan= PJ::where('pelayanan_id',$pelayanan->id)
        ->where('tanggal', '=', $date)
        ->where('refs->antrian', '!=', "")
        ->count();

        $no_antrian  = $pelayanan->refs['kode'].''.($cont_serve_pelayanan+1);

        //create new PJ

        $newPJ = new PJ();
        $newPJ->klien_id = 0;
        $newPJ->pelayanan_id = $request->pelayanan_id;
        
        $newPJ->tanggal = Carbon::now()->format('Y-m-d');
        $newPJ->refs = ['antrian' => $no_antrian,'daftar'=>'goshow','status'=>'menunggu'];
        $newPJ->save();
        

        
        
        return response()->json([
            'success' => 1,
            'data' => $newPJ,
            'noAntrian'=>$no_antrian
            // 'data'=>$data
        ]);

    }
}
