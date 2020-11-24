<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function articulo(){
        return $this->hasOne("App\Models\Articulo");
    }
    public function articulos(){
        return $this->hasMany("App\Models\Articulo");
    }

    // Modelo relacion varias tablas con Tabla cliente_perfil de pivo 
    public function perfils(){
        return $this->belongsToMany("App\Models\Perfil");
    }

    public function calificaciones(){
        return $this->morphMany("App\Models\calificaciones","calificacion");
    }
    // use HasFactory;
    protected $fillable=["Nombre","Apellidos"];
}
