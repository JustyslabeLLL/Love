<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = ['name', 'price', 'duration'];

    // Связь "многие ко многим" с мастерами
    public function masters()
    {
        return $this->belongsToMany(Master::class, 'master_service');
    }

    // app/Models/Service.php
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
