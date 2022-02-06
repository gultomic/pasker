<?php
//TODO : should we update existing client with same phone number ? for now not update current data
//TODO: Refactor code get no atrian from total to get last number
namespace App\Http\Controllers;

use App\Events\QueuesService;
use App\Models\Config;
use App\Models\Klien;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Auth;
use Carbon\Carbon;

class RegistrationController extends Controller
{

    public function online_home(Request $request){

        $pelayanan = Pelayanan::latest()
        ->where('refs->aktif', '=', true)
        ->get();

        //get list of jam loket avilable
        $jam_loket = Config::where('title','loket_jam')->first();


//        return $jam_loket->refs->toJSON();
        return view('registration.online.home', [
            'pelayanan'=>$pelayanan,
            'jam_loket'=>$jam_loket->refs->toJSON()
        ]);




    }

    public function online_submit(Request $request)
    {
        //todo validate

        //find by id

        //return response()->json($request);
        $sel_pelayanan = Pelayanan::find($request->pelayanan);

        //todo: validate pelayanan exist and active


        //check klien if exist
        $ex_klien = Klien::where('phone', $request->phone)->first();
        //$klienId = $ex_klien->id;
        $tanggal_booking = Carbon::parse($request->tanggal)->format('Y-m-d');

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
            //check for booking on same date
            $exist_request = PJ::where([
                'klien_id'=>$klienId,
                'tanggal'=>$tanggal_booking
            ])->first();

            if ($exist_request) {
                $date_exist = Carbon::parse($exist_request->tanggal)->format('d M Y') . " - Pukul ".$exist_request->refs['jam_booking'];
                return redirect(route('registration.online.home'))
                ->with('exist_request_date', $date_exist);
               // Do stuff if it doesn't exist.
            }
        }


        $newPJ = new PJ();
        $newPJ->klien_id = $klienId;
        $newPJ->pelayanan_id = $sel_pelayanan->id;

        $newPJ->tanggal = $tanggal_booking;
        $newPJ->refs = ['antrian' => '','daftar'=>'online','jam_booking'=>$request->jam];
        $newPJ->save();



        //return redirect(route('registration.online.success'))->with('name', $request->nama);
        return redirect(route('registration.online.success'))
            ->with('nama', $request->nama)
            ->with('booking_time', Carbon::parse($request->tanggal)->format('d M Y') . " - Pukul ".$request->jam);

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

        $trailing_no  = str_pad($cont_serve_pelayanan+1, 3, '0', STR_PAD_LEFT);
        $no_antrian  = $pelayanan->refs['kode'].' '.$trailing_no;

        //create new PJ

        $newPJ = new PJ();
        $newPJ->klien_id = 0;
        $newPJ->pelayanan_id = $request->pelayanan_id;


        $newPJ->tanggal = Carbon::now()->format('Y-m-d');
        $newPJ->refs = ['antrian' => $no_antrian,'daftar'=>'goshow','status'=>'menunggu'];
        $newPJ->save();


        event(new QueuesService(['call'=>false]));

        return response()->json([
            'success' => 1,
            'data' => $newPJ,
            'noAntrian'=>$no_antrian
            // 'data'=>$data
        ]);

    }

}
