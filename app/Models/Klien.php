<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;


class Klien extends Model
{
    protected $table = 'klien';
    // protected $guarded = [];
    // protected $fillable = [];
    protected $casts = [
        'refs' => AsCollection::class,
    ];
}
