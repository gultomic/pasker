<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Carbon\Carbon;

class Pelayanan extends Model
{
    use SoftDeletes;

    protected $table = 'pelayanan';
    // protected $guarded = [];
    // protected $fillable = [];
    protected $casts = [
        'refs' => AsCollection::class,
    ];

    public function kuesioner ()
    {
        return $this->hasMany(Kuesioner::class, 'pelayanan_id', 'id');
    }

    public function jadwal ()
    {
        return $this->hasMany(PelayananJadwal::class, 'pelayanan_id', 'id');
    }

    public function pengunjung ()
    {
        return $this->jadwal()->whereNotNull('pelaksana_id');
    }

    public function antrianHariIni ()
    {
        return $this->jadwal()
            ->where('tanggal', '=', Carbon::now()->format('Y-m-d'));
    }

//    public function antrianHariIniActive ()
//    {
//        return $this->jadwal()
//            ->where('refs->antrian','!=',"")
//            ->where('tanggal', '=', Carbon::now()->format('Y-m-d'));
//    }

    public function isLimit()
    {
        return $this->antrianHariIni()
//                ->where('refs->status', '!=', "selesai")
//                ->where('refs->status', '!=', "tidak_hadir")
                ->count() >= $this->refs['antrian'];
    }
}
