<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;

    protected $table = 'survei';
    // protected $guarded = [];
    // protected $fillable = [];
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;
}
