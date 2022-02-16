<?php
//TODO : should we update existing client with same phone number ? for now not update current data

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

    public function online_home(Request $request)
    {

        $pelayanan = Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();

        //get list of jam loket avilable
        $jam_loket = Config::where('title', 'loket_jam')->first();


//        return $jam_loket->refs->toJSON();
        return view('registration.online.home', [
            'body_id' => 'landing',
            'pelayanan' => $pelayanan,
            'jam_loket' => $jam_loket->refs->toJSON()
        ]);


    }

    public function online_submit(Request $request)
    {



        //return response()->json($request);
        $sel_pelayanan = Pelayanan::find($request->pelayanan);

        //todo: validate pelayanan exist and active by now we assume all pelayanan are active


        //check klien if exist
        $ex_klien = Klien::where('phone', $request->phone)->first();
        //$klienId = $ex_klien->id;
        $tanggal_booking = Carbon::parse($request->tanggal)->format('Y-m-d');

        if (empty($ex_klien)) {
            $newKlien = new Klien();
            $newKlien->name = $request->nama;
            $newKlien->phone = $request->phone;

            if (empty($request->email)) {
                $request->email = "";
            }

            $newKlien->email = $request->email;

            $newKlien->save();
            $klienId = $newKlien->id;
        } else {
            $klienId = $ex_klien->id;
            //check for booking on same date
            $exist_request = PJ::where([
                'klien_id' => $klienId,
                'tanggal' => $tanggal_booking
            ])->first();

            if ($exist_request) {
                $date_exist = Carbon::parse($exist_request->tanggal)->format('d M Y') . " - Pukul " . $exist_request->refs['jam_booking'];
                return redirect(route('registration.online.home'))
                    ->with('exist_request_date', $date_exist);
                // Do stuff if it doesn't exist.
            }
        }

        $createPJ = (new PJ)->createPJ(
            $request->pelayanan,
            $klienId,
            'online',
            "create",
            0,
            false,
            ['jam_booking' => $request->jam],
            $tanggal_booking
        );


        if ($createPJ['error'] == 1) {
            return redirect(route('registration.online.home'))
                    ->with('flash_error', $createPJ['message']);
        }

        //return redirect(route('registration.online.success'))->with('name', $request->nama);
        return redirect(route('registration.online.success'))
            ->with('nama', $request->nama)
            ->with('booking_time', Carbon::parse($request->tanggal)->format('d M Y') . " - Pukul " . $request->jam);

    }

    public function kiosk_submit_phone(Request $request)
    {
        //found klien first
        $klien = Klien::where('phone', $request->phone)->first();
        $date = Carbon::now()->format('Y-m-d');

        if (empty($klien)) {
            return response()->json([
                'success' => 0,
                'code'=>'booking_not_found',
                'check'=>"kleint"
            ]);
        }

        // then check booking date is today
        $booking_data = PJ::where('klien_id', $klien->id)
            ->where('tanggal', '=', $date)
            ->where('refs->antrian', '=', "")
            ->first();


        if (empty($booking_data)) {
            return response()->json([
                'success' => 0,
                'code'=>'booking_not_found',
                'check'=>"jadwal"
            ]);
        }


        $createPJ = (new PJ)->createPJ($booking_data->pelayanan_id,$klien->id,$booking_data->refs['daftar'],"update",$booking_data->id);


        if ($createPJ['error'] == 1) {
//            return $createPJ;
            return response()->json([
                'success' => 0,
                'code' => $createPJ['code'] ?? "",
                'message' => $createPJ['message']??""
            ]);
        }

        event(new QueuesService([
            'call' => false,
            'pid' => $createPJ["data"]->pelayanan_id,
            'type' => 'staff'
        ]));


        return response()->json([
            'success' => 1,
            'data' => $createPJ,
            'noAntrian' => $createPJ["data"]->refs['antrian'],
            'pelayanan' => $createPJ["data"]->pelayanan->title,
            // 'data'=>$data
        ]);

    }

    public function kiosk_submit(Request $request)
    {


        //find bookingdata and create antrian

        //send to PJ
        $createPJ = (new PJ)->createPJ($request->pelayanan_id,0,"goshow");


        if ($createPJ['error'] == 1) {
//            return $createPJ;
            return response()->json([
                'success' => 0,
                'code' => $createPJ['code'] ?? "",
                'message' => $createPJ['message']??""
            ]);
        }


        event(new QueuesService([
            'call' => false,
            'pid' => $request->pelayanan_id,
            'type' => 'staff'
        ]));

        return response()->json([
            'success' => 1,
            'data' => $createPJ["data"],
            'noAntrian' => $createPJ["data"]->refs['antrian'],
            'pelayanan' => $createPJ["data"]->pelayanan->title,
            // 'data'=>$data
        ]);

    }

    public function get_pelayanan(Request $request)
    {

        $pelayanan = Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();

        $available_pel = new Pelayanan();

        if ($request->type == "all") {
            $available_pel = $pelayanan;
        } else {
            $available_pel = $pelayanan->filter(function ($value, $key) {
                if (!$value->isLimit()) {
                    return true;
                }
            })->values();
        }


        return response()->json($available_pel);
    }

}
