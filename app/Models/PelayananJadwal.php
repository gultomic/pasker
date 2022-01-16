<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class PelayananJadwal extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'pelayanan_jadwal';
    protected $keyType = 'uuid';
    // protected $guarded = [];
    // protected $fillable = [];
    protected $casts = [
        'refs' => AsCollection::class,
        'tanggal' => 'date',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public $incrementing = false;

    public function pengunjung()
    {
        return $this->belongsTo(Klien::class, 'klien_id', 'id');
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
}
