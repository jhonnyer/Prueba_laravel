<?php

namespace App\Models;
// namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    // use HasFactory;
    // protected $table="articulos";
    // protected $fillable=[
    //     "cliente_id",
    //     "Nombre_Articulo",
    //     "Precio",
    //     "Pais_origen",
    //     "Observaciones",
    //     "seccion"
    // ];

    public function cliente(){
        return $this->belongsTo("App\Models\Cliente");
    }

    public function calificaciones(){
        return $this->morphMany("App\Models\calificaciones","calificacion");
    }
}
