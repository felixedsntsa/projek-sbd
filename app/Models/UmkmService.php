<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmService extends Model
{
    protected $table = 'umkm_services';

    protected $fillable = [
        'umkm_id',
        'service_id',
    ];
}
