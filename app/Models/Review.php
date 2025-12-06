<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'umkm_id',
        'user_id',
        'rating',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
