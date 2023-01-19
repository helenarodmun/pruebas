<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


////////////////////////////Ejercicio 1 ///////////////////////////

Route::get('/prueba/{name?}', function ($name = 'Invitado') {
    return "Bienvenido a la página de pruebas {$name}";
});

Route::post('/pruebaPost', function () {
    return "Página pruebas POST";
});

Route::match(['get', 'post'], '/metodosVarios', function () {
    return "Página pruebas de ruta que permite dos métodos POST y GET";
});

Route::get('/testeaParametros1/{num}', function () {
    return "Acepta si son valores númericos";
})->where('num', '[0-9]+') ;

Route::get('/testeaParametros1/{num}', function () {
    return "Acepta si el primer parámetro es númerico y el segundo strings";
})->where('num', '[0-9]+') ;

Route::get('/testeaParametros2/{palabra}/{num}', function () {
    return "Acepta si el primer parámetro está formado por letras y el segundo por números";
})->where(['palabra' => '[A-Za-z]+'], ['id' => '[0-9]+']);

//////////////////////////////////////////////////////////////////

////////////////////////////Ejercicio 2 //////////////////////////

Route::get('/host', function() {
    $host = env('DB_HOST');
    return "Dirección IP donde se encuentra la base de datso: {$host}";
});

Route::get('/timezone', function() {
    $zonaHoraria = config('app.timezone');
    return "Estamos en la zona horaria: {$zonaHoraria}";
});
//////////////////////////////////////////////////////////////////

////////////////////////////Ejercicio 3 //////////////////////////

Route::get('/inicio', function () {
    return view('/prueba/home');
});

Route::get('/fecha', function () {
    $dia = date("D");
    $mes = date("F");
    $year = date("Y");
    return view('/prueba/fecha' , ['dia' => $dia, 'mes' => $mes, "year" => $year]);
});

Route::get('/fecha2', function () {
    $dia = date("D");
    $mes = date("F");
    $year = date("Y");
    $var_fecha = array("dia", "mes", "year");
    return view('/prueba/fecha' , $res=compact($var_fecha));
});

Route::get('/fecha3', function() {
    $dia = date("D");
    $mes = date("F");
    $year = date("Y");
    return view('/prueba/fecha') 
    ->with('dia', $dia)
    ->with('mes', $mes)
    ->with('year', $year);
});

Route::get('/error404', function () {
    return view('/prueba/error404')
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('community/{name?}', [App\Http\Controllers\CommunityLinkController::class, 'index']);
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);

require __DIR__.'/auth.php';
