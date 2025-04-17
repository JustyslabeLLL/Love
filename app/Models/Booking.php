<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'master_id',
        'service_id',
        'booking_date',
        'client_name',
        'client_phone',
        'email', // Добавляем `email` в массив
        'total_duration' // Добавляем это поле
    ];
    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
