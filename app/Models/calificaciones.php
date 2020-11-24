<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificaciones extends Model
{
    public function calificacion(){
        return $this->morphTo();
    }
    // use HasFactory;
}
