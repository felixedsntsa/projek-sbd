<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'name',
    ];

    // RELASI: Service → Category (many to one)
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    // RELASI: many to many ke UMKM via pivot
    public function umkms()
    {
        return $this->belongsToMany(Umkm::class, 'umkm_services');
    }
}
