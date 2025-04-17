<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Master extends Model
{
    protected $fillable = ['name', 'description'];

    // Связь "многие ко многим" с услугами
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
