<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Profile extends Model
{
    protected $guarded = [];
    protected $primaryKey = null;
    protected $casts = [
        'refs' => AsCollection::class,
    ];

    public $incrementing = false;
    public $timestamps = false;
}
