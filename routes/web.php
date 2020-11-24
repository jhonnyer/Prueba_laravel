<?php

use Illuminate\Support\Facades\Route;
use App\Models\Articulo;
use App\Models\Cliente;


// namespace App\Articulo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/","Micontrolador@index");
Route::get("/inicio","Micontrolador@index");
Route::get("/crear","Micontrolador@Create");
Route::get("/articulos","Micontrolador@store");
Route::get("/mostrar","Micontrolador@show");
Route::get("/contacto","Micontrolador@contactar");
Route::get("/galeria","Micontrolador@galeria");



// INSTRUCCIONES MYSQL

// Route::get("/insertar", function(){
    // DB::insert("INSERT INTO articulos (Nombre_Articulo, Precio, Pais_origen, seccion, Observaciones) VALUES (?,?,?,?,?)", ["Zapatos", 15.2,"Peru","Ropa","Promocion"]);
// });

// Route::get("/leer", function(){
//     $resultados=DB::select("SELECT * FROM articulos WHERE ID=?",[1]);
//     foreach($resultados as $articulo){
//         return $articulo->Nombre_Articulo;
//     }
// });


// Route::get("/actualizar", function(){
//     DB::update("UPDATE articulos SET seccion='Decoración' WHERE ID=?",[1]);
// });

// Route::get("/eliminar", function(){
//     DB::update("DELETE FROM articulos WHERE ID=?",[1]);
// });

// INSTRUCCIONES ELOQUENT

// Leer todos los datos de una tabla en la DB
// Route:: get("/leer", function(){
    // $articulos=Articulo::all();
    // foreach($articulos as $articulo){
        // echo "Nombre:" . $articulo->Nombre_Articulo . "Precio: " . $articulo->Precio . "<br>";
    // }    
// });

// Route::get("/leer", function(){
    // $articulos=Articulo::all();
    // foreach($articulos as $articulo){
        // echo $articulo->Nombre_Articulo;
    // }
// });

// Consulta DB con filtros o restricciones 
// Opcional (primer registro de la tabla)
// ->take(1)

// Route:: get("/leer", function(){
//     $articulos=Articulo::where("Pais_origen", "Colombia")->orderBy("Nombre_Articulo")->get();
//     return $articulos;   
//     });  

// Operaciones en la base de datos con el precio mas alto
// Route::get("/leer", function(){
//     $articulos=Articulo::where("Pais_origen", "Colombia")->min("Precio");
//     return $articulos;
//     });    

// Consultar un solo dato por el id y la posicion
// Route::get("/leer", function(){
//  $articulos=Articulo::where("id", 4)->get();
//  return $articulos;
//  });  

 
// Consultar datos borrados en Papelera
Route::get("/leer", function(){
 $articulos=Articulo::withTrashed()
    ->where("id", 4)
    ->get();
    return $articulos;
 }); 
 
Route::get("/restaurar", function(){
    $articulos=Articulo::withTrashed()
    ->where("id", 4)
    ->restore();
    }); 


// Insertart un dato
// Route::get("/insertar", function(){
//     $articulos=new Articulo;
//     $articulos->Nombre_Articulo="Pantaloneta";
//     $articulos->Precio=60;
//     $articulos->Pais_origen="España";
//     $articulos->Observaciones="Lavar a mano";
//     $articulos->seccion="Ropa";
//     $articulos->save();
//     });  

// Atualizar un dato
// Route::get("/actualizar", function(){
//     $articulos=Articulo::find(7);
//     $articulos->Nombre_Articulo="Pantaloneta";
//     $articulos->Precio=85;
//     $articulos->Pais_origen="España";
//     $articulos->Observaciones="Lavar a mano";
//     $articulos->seccion="Ropa";
//     $articulos->save();
//     });  

// Actualizar un unico registro
// Route::get("/actualizar", function(){
//     Articulo::where("seccion","Ceramica")->update(["seccion"=>"Aseo"]);
    
//     });  
// Actualizar un unico registro con dos parametros
Route::get("/actualizar", function(){
    Articulo::where("seccion","Alimentos")->where("Pais_origen","Colombia")->update(["Precio"=>68]);
    });  

// Route::get("/borrar", function(){
//     $articulo=Articulo::find(7);
//     $articulo->delete();
//     });  

Route::get("/borrar", function(){
    Articulo::where("seccion","Ropa")->delete();
    });  

Route::get("/insertarvarios", function(){
    Articulo::create(["cliente_id"=>6,"Nombre_Articulo"=>"Camisa","Precio"=>18,"Pais_origen"=>"Venezuela","Observaciones"=>"Ropa","seccion"=>"Ropa"]);
    });  

Route::get("/softdelete", function(){
    Articulo::find(4)->delete();
    });  


Route::get("/hardDelete", function(){
    $articulos=Articulo::withTrashed()
    ->where('id',4)
    ->forceDelete();    
    });  


// Relacionar Tablas 1:1
Route::get("/cliente/{id}/articulo",function($id){
    return Cliente::find($id)->articulo;
});

Route::get("/articulo/{id}/cliente",function($id){
    return Articulo::find($id)->cliente->Nombre;
});

// Filtro por varios articulos un solo cliente
// Route::get("/articulos",function(){
//     $articulos=Cliente::find(1)->articulos;
//     foreach ($articulos as $articulo){
//         echo $articulo->Nombre_Articulo . "<br/>";
//     }
// });


Route::get("/articulos",function(){
    $articulos=Cliente::find(1)->articulos->where("Pais_origen","Venezuela");
    foreach ($articulos as $articulo){
        echo $articulo->Nombre_Articulo . "<br/>";
    }
});

Route::get("/Cliente/{id}/perfil", function($id){
    $cliente=Cliente::find($id);
    foreach($cliente->perfils as $perfil){
        return $perfil->nombre;
    }
});

// Relacion polimorfica, insertar comentarios y calificacion
Route::get("/calificaciones_clientes",function(){
    $cliente=Cliente::find(2);
    foreach($cliente->calificaciones as $calificacion){
        return $calificacion->calificacion;
    }
});

Route::get("/calificaciones_Articulos",function(){
    $articul=Articulo::find(1);
    foreach($articul->calificaciones as $calificacion){
        return $calificacion->calificacion;
    }
});