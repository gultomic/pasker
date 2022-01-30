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

    public function kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'pelayanan_id', 'id');
    }

    public function pengunjung()
    {
        return $this->hasMany(PelayananJadwal::class, 'pelayanan_id', 'id')
            ->whereNotNull('pelaksana_id');
    }

    public function antrianHariIni()
    {
        return $this->pengunjung()
            ->where('tanggal', '=', Carbon::now()->format('Y-m-d'))
            // ->where('refs->antrian', '!=', null)
            // ->orderBy('refs->antrian', 'asc')
            ;
    }
}
