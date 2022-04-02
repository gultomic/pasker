<?php

namespace App\Models;

// use App\Traits\Uuid;
use App\Events\QueuesService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use DB;
use App\Models\PelayananJadwal as PJ;

class PelayananJadwal extends Model
{
    // use Uuid;
    use SoftDeletes;

    protected $table = 'pelayanan_jadwal';
    // protected $keyType = 'string';
    // protected $primaryKey = 'uuid';
    // protected $guarded = [];
    // protected $fillable = [];
    protected $casts = [
        'refs' => AsCollection::class,
        'tanggal' => 'date',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    // public $incrementing = false;

    public function pengunjung()
    {
        return $this->belongsTo(Klien::class, 'klien_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'pelaksana_id', 'id');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id', 'id');
    }

    public function pelaksana()
    {
        return $this->belongsTo(Profile::class, 'pelaksana_id', 'user_id');
    }

    public function survei()
    {
        return $this->hasMany(Survei::class, 'jadwal_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->format('Y-m-d H:i:s');
    }

    public function getTanggalAttribute($value)
    {
        return \Carbon\Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->format('Y-m-d');
    }

    public function createPJ(
        $pelayanId,
        $klienId=0,
        $daftarType="online",
        $type="create",
        $PJId=0,
        $ambilAntrian=true,
        $addRefs=[],
        $tanggal=null,
        $withEvent = true,
    ){
        try {

            DB::connection('mysql')->beginTransaction();
            //run insert or create here
            $date = Carbon::now()->format('Y-m-d');

            $pelayanan = Pelayanan::find($pelayanId);


            //VALIDATION START
            //check pelayanan is aktif
            if(!$pelayanan->refs['aktif']){
                return [
                    'error' => 1,
                    'data' => [],
                    'code'=>"pelayanan_unactive",
                    'message' => "Pelayanan Tidak Aktif. Silahkan pilih pelayanan lain"
                ];
            }

            //check pelayanan isnt limit
            //for now online booking are always accepted
            if(empty($tanggal)) {
                if ($pelayanan->isLimit()) {
                    return [
                        'error' => 1,
                        'data' => [],
                        'code' => "pelayanan_limit",
                        'message' => "Pelayanan Yang Anda Pilih Melebihi Limit. Silahkan pilih pelayanan lain, atau hubungi petugas",
                    ];
                }
            }

            //VALIDATION END
            //START CREATE ANTRIAN
            $no_antrian ="";
            if($ambilAntrian) {
                $trailing_no = str_pad($pelayanan->antrianHariIni()->where('refs->antrian', '!=', "")->where('refs->daftar', '=', $daftarType)->count() + 1, 3, '0', STR_PAD_LEFT);
                $no_antrian = $pelayanan->refs['kode'] . '' . $trailing_no.( $daftarType == "online" ? " OL":"" );
            }

            $PJ = new PJ();

            if($type == "create") {

                $PJ->klien_id = $klienId;
                $PJ->pelayanan_id = $pelayanId;
                $PJ->tanggal = (empty($tanggal)) ? Carbon::now()->format('Y-m-d') : $tanggal;

                $refsData = array_merge([
                    'antrian' => $no_antrian,
                    'daftar' => $daftarType,
                    'status' => $ambilAntrian ? 'menunggu' : ""
                ], $addRefs);
                $PJ->refs = $refsData;

            }else{
                //is update PJ
                $PJ = PJ::find($PJId);
                $PJ->refs['antrian']=$no_antrian;
                $PJ->refs['status']=$ambilAntrian ? 'menunggu' :"";

            }

            $PJ->save();

            if($ambilAntrian) {
                event(new QueuesService([
                    'call' => false,
                    'pid' => $PJ->pelayanan_id,
                    'type' => 'staff'
                ]));
            }

            DB::connection('mysql')->commit();
            $return = ['error' => 0, 'data' => $PJ, 'message' => "Berhasil Membuat Antrian"];
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            $return = ['error' => 1, 'message' => $e->getMessage()];
        }
        return $return;
    }
}
