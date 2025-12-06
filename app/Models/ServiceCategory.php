<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    // RELASI: ServiceCategory → Service (1 kategori memiliki banyak layanan)
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
