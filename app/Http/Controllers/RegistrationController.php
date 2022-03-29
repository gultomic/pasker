<?php
//TODO : should we update existing client with same phone number ? for now not update current data

namespace App\Http\Controllers;

use App\Events\QueuesService;
use App\Models\Config;
use App\Models\Klien;
use App\Models\PelayananJadwal;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RegistrationController extends Controller
{

    public function online_home(Request $request)
    {

        $pelayanan = Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get();

        //get list of jam loket avilable
        $jam_loket = Config::where('title', 'loket_jam')->first();

        //return $jam_loket->refs;
        $tgl_merah = file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json");
//        $loc = public_path('/assets/test_tgl_merah.json');
//        $tgl_merah = file_get_contents($loc);

//        return $tgl_merah;
//        return $jam_loket->refs->toJSON();
        return view('registration.online.home', [
            'body_id' => 'landing',
            'pelayanan' => $pelayanan,
            'jam_loket' => $jam_loket->refs->toJSON(),
            'tglMerah'=>$tgl_merah
        ]);


    }

    public function online_submit(Request $request)
    {



        //return response()->json($request);
        $sel_pelayanan = Pelayanan::find($request->pelayanan);




        //check klien if exist
        $ex_klien = Klien::where('phone', $request->phone)->first();

        //$klienId = $ex_klien->id;
        $tanggal_booking = Carbon::parse($request->tanggal)->format('Y-m-d');

        //do check client using wrong email
        //return $ex_klien->email;


        if(!empty($request->email)){
            $ex_klienbyEmail = Klien::where('email', $request->email)->first();
            if(!empty($ex_klien) && ( $request->email != $ex_klien->email) ){
                $realMail = explode('@',$ex_klien->email);
                $preMailMask = substr($realMail[0], 0, 3);
                $preMailMask2 = substr($realMail[1], 0, 3);
                $dotMask = explode('.',$realMail[1]);
                $mailMask = $preMailMask."***@".$preMailMask2."***.".$dotMask[1];

                return redirect(route('registration.online.home'))
                        ->with('client_error', "Email yang digunakan tidak sesuai dengan database, silahkan gunakan email berikut: ".$mailMask."<br/>Atau gunakan No Handphone lain")
                ->withInput();
            }

            if(!empty($ex_klienbyEmail) && ( $request->phone != $ex_klienbyEmail->phone) ){
                $prePhoneMask = substr($ex_klienbyEmail->phone, 0, 3);
                $prePhoneMask2 = substr($ex_klienbyEmail->phone, -3);
                $phoneMask = $prePhoneMask."****".$prePhoneMask2;

                return redirect(route('registration.online.home'))
                        ->with('client_error', "Email sudah pernah terdaftar, silahkan gunakan email lain. Atau gunakan no Handphone ".$phoneMask)
                    ->withInput();
            }

        }


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



            //check for booking on next date
            $exist_request = PJ::where([
                'klien_id' => $klienId
            ])
                ->where('refs->antrian','=',"")
                ->whereDate('tanggal','>=',Carbon::now()->format('Y-m-d'))
                ->first();



            if ($exist_request) {
                $date_exist = Carbon::parse($exist_request->tanggal)->format('d M Y') . " - Pukul " . $exist_request->refs['jam_booking'];
                return redirect(route('registration.online.home'))
                    ->with('exist_request_date', $date_exist)
                    ->withInput();
                // Do stuff if it doesn't exist.
            }

            //update klien data
            $ex_klien->name = $request->nama;
            $ex_klien->email = $request->email ?? "";
            $ex_klien->save();
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

        $encrypt = "puspakeranol-".Crypt::encryptString($createPJ['data']['id']);
        $qrcode = QrCode::size(170)->generate($encrypt);

        return redirect(route('registration.online.success'))
            ->with('nama', $request->nama)
            ->with('booking_time', Carbon::parse($request->tanggal)->format('d M Y') . " - Pukul " . $request->jam)
            ->with('booking_qrcode', $qrcode)
            ->with('booking_enc', $encrypt);

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

//        return response()->json([
//            'success' => 1,
//            //'data' => $createPJ,
//            'noAntrian' => "A001",
//            'pelayanan' => "Pelayan Test",
//            // 'data'=>$data
//        ]);

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

    public function kiosk_submit_barcode(Request $request){
        if(empty($request->barcode)){
            return response()->json([
                'success' => 0,
                'code'=>'barcode_not_found',
                'message'=>"Kode Barcode tidak ditemukan"
            ]);
        }

        //replace first
        $clean = str_replace("puspakeranol-","",$request->barcode);

        try {
            $decrypted = Crypt::decryptString($clean);
            return response()->json([
                'success' => 1,
                'code'=>'barcode_found',
                'message'=>"Nemu nih : ".$decrypted
            ]);
        } catch (DecryptException $e) {
            //
             return response()->json([
                'success' => 0,
                'code'=>'barcode_not_found',
                'message'=>$e->getMessage()
            ]);
        }
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

    public function get_quota_per_day(Request $request){
        $configs= Config::where('title', 'loket_jam')->first()->refs->toArray();

        if(empty($request->day)){
            return response()->json("Hari tidak ditemukan",400);
        }

        if(empty($request->pelayanan)){
            return response()->json("Pelayanan tidak ditemukan",400);
        }

        $dayOfWeek = Carbon::createFromFormat('Ymd', $request->day)->dayOfWeek;
        $sel_day = $configs[$dayOfWeek];
        $jambuka  = explode(':',$sel_day['jam_buka']);
        $jamtutup  = explode(':',$sel_day['jam_tutup']);
        //return $jambuka[0];
        $count =  $jamtutup[0]-$jambuka[0];
//        return $count;
        $arr_jam = [];
        for($i=0;$i<= $count;$i++){

            if($jambuka[0] + $i != 12) {
                $arr = [];
                $timestr = str_pad($jambuka[0] + $i, 2, '0', STR_PAD_LEFT) . ":00";
                $arr['jam'] = $jambuka[0] + $i;
                $arr['jam_str'] = $timestr;
//                if($jambuka[0] + $i == 11){
//                    $arr['quota'] = 0;
//                }else {

                    $arr['quota'] = $this->getPelayananJadwalQuota($request->day, $timestr, $request->pelayanan, $sel_day['kuota_per_jam']);
//                }
                array_push($arr_jam,$arr);
            }

        }

        return $arr_jam;
    }

    private function getPelayananJadwalQuota($date,$time,$pelayanan,$limit){
        $date_call = Carbon::createFromFormat('Ymd', $date)->format('Y-m-d');
        $entry  = PelayananJadwal::where('pelayanan_id',$pelayanan)
            ->where('tanggal', '=', $date_call)
            ->where('refs->jam_booking', '=', $time)
            ->where('refs->daftar','=','online')
            ->count();
        return $limit-$entry;
    }

}
