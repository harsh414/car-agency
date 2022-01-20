<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function agent() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function ifCarBelongsToAgent(User $user,Car $car) {
        return $car->agent== $user;
    }
}
