<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'image',
        'opening_hours',
        'geom',
    ];

    // RELASI: many to many ke services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'umkm_services');
    }

    // RELASI: UMKM → Gambar UMKM (1 UMKM banyak gambar)
    public function images()
    {
        return $this->hasMany(UmkmImage::class);
    }

    // RELASI: UMKM → Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
