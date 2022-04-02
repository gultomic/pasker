<?php
// TODO : update telat
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
            ->with('booking_author', $request->nama .' | '.$request->phone.' | '.$request->email ?? "")
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
                'code'=>'barcode_not_found',
                'title'=>"No Handphone Tidak ditemukan",
                'message'=>"No Handphone. Pastikan No Handphone yang Anda masukkan sudah benar",
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
                'title'=>'Jadwal Tidak Ditemukan',
                'message'=>"Jadwal tidak ditemukan di hari ini. Patikan Anda sudah mempunyai jadwal untuk hari ini <br/> Silahkan ambil antrian offline jika anda menginginkan kunjungan saat ini"
            ]);
        }

        return response()->json($this->checkBookingJadwal($booking_data));


    }

    public function kiosk_submit_barcode(Request $request){

        if(empty($request->barcode)){
            return response()->json([
                'success' => 0,
                'code'=>'barcode_not_found',
                'title'=>"Kode Booking Tidak ditemukan",
                'message'=>"Kode Booking ditemukan. Pastikan QRCode yang Anda scan sudah benar",
            ]);
        }

        //replace first
        $clean = str_replace("puspakeranol-","",$request->barcode);

        try {

            $decrypted = Crypt::decryptString($clean);
            $bookingData = PelayananJadwal::find($decrypted);
            //start check jadwalpelayanan
            return response()->json($this->checkBookingJadwal($bookingData));

        } catch (DecryptException $e) {
            //
             return response()->json([
                'success' => 0,
                'code'=>'barcode_not_found',
                'title'=>"Kode Booking Tidak ditemukan",
                'message'=>"Kode Booking ditemukan. Pastikan QRCode yang Anda scan sudah benar",
            ]);
        }
    }

    private function checkBookingJadwal($jadwal){
        $return['success'] = 0;
        $return['title'] = "Unknown Error";
        $return['message'] ="Unknown error, Silahkan hubungi petugas";



        //start check jadwalpelayanan
//        $jadwal = PelayananJadwal::find($jadwalId);

        if(empty($jadwal)){
            $return['title'] = "Jadwal Tidak Ditemukan";
            $return['message'] = "Jadwal tidak ditemukan. Pastikan QRCode yang Anda scan sudah benar";
            return $return;
        }

        if($jadwal->refs['antrian']!=""){
            $return['title'] = "Jadwal sudah digunakan";
            $return['message'] = "Jadwal sudah digunakan hari ini";
            return $return;
        }

        if(!empty($jadwal)){
            //do check hari sama atau tidak
            if($jadwal->tanggal != Carbon::now()->format('Y-m-d') && $jadwal->refs['antrian']=="" ){
                $return['title'] = "Jadwal Tidak Ditemukan";
                $return['message'] = "Jadwal tidak ditemukan di hari ini. Jadwal anda adalah ".Carbon::parse($jadwal->tanggal)->format('d M Y')." Pukul : ".Carbon::parse($jadwal->refs['jam_booking'])->format('H').":00 <br/> Silahkan ambil antrian offline jika anda menginginkan kunjungan saat ini";
                return $return;
            }

            // if true is today booking
            if($jadwal->tanggal == Carbon::now()->format('Y-m-d') && $jadwal->refs['antrian']=="" ){
                //check if pelayanan aktif
                if(!Pelayanan::find($jadwal->pelayanan_id)->refs['aktif']){
                    $return['title'] = "Pelayanan yang Anda Booking Tidak aktif";
                    $return['message'] = "Mohon maaf saat ini pelayanan yang anda booking sedang tidak aktif. <br/> Silahkan ambil antrian offline jika anda menginginkan kunjungan dengan pelayanan yang lain";
                    return $return;
                }

                if(!empty($jadwal->refs['jam_booking'])) {

                    $jambooking = Carbon::parse($jadwal->refs['jam_booking'])->format('H');
                    $currHour = Carbon::now()->hour;
                    $currMinute = Carbon::now()->minute;

                    //do check kepagian
                    if($jambooking > $currHour){

                        $return['title'] = "Jadwal Anda Belum Tersedia di Jam Ini";
                        $return['message'] = "Jadwal anda belum tersedia di jam ini. Jadwal anda hari ini pukul : ".$jambooking.":00 <br/> Silahkan ambil antrian offline jika anda menginginkan kunjungan saat ini";
                        return $return;
                    }

                    //do check kesiangan
                    if(($jambooking == $currHour && $currMinute > 30) || $jambooking < $currHour){

                        $return['title'] = "Jadwal Anda Telah Terlewat";
                        $return['message'] = "Jadwal anda telah terlewat. Jadwal anda hari ini pukul : ".$jambooking.":00 - ".$jambooking.":30 <br/> Silahkan ambil antrian offline jika anda menginginkan kunjungan saat ini";
                        return $return;
                    }

                    //all OKE Silahkan MAsuk

                    $createPJ = (new PJ)->createPJ($jadwal->pelayanan_id, $jadwal->klien_id, $jadwal->refs['daftar'], "update", $jadwal->id);

                    if ($createPJ['error'] == 1) {
                        $return['title'] = "Upps... terjadi kesalahan";
                        $return['message'] = $createPJ['message'] ?? "Terjadi kesalahan saat memproses data. Silahkan ulangi code:" . $createPJ['message'];
                    } else {

                        $return['success'] = 1;
                        $return['title'] = "Berhasil";
                        $return['message'] = "Memncetak no antrian . silahkan menunggu..";
                        $return['noAntrian'] = $createPJ["data"]->refs['antrian'];
                        $return['pelayanan'] = $createPJ["data"]->pelayanan->title;
                    }

                    return $return;


                }
            }

        }

        return $return;
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

//
//        event(new QueuesService([
//            'call' => false,
//            'pid' => $request->pelayanan_id,
//            'type' => 'staff'
//        ]));

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
