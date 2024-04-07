<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigradorController;
use App\Http\Controllers\MysqlController;

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


Route::get('/migrador', [MigradorController::class, 'mostrarVista'])->name('mostrar.Vista');

<<<<<<< Updated upstream
Route::get('/migradors', [MigradorController::class, "convertirJson"])->name('ver.migrador');

Route::get('/ejecutar', [MigradorController::class, "ejecutarConsulta"])->name('ejecuta.consulta');



# rutas de juan
Route::post('/MysqlSchema', [MysqlController::class, "obtenerSchemaDatabase"]);
=======
Route::get('/convertir-json',[MigradorController::class,"convertirJson"])->name('ver.migrador');

Route::get('/ejecutar/{database}/{consulta}',[MigradorController::class,"ejecutarConsulta"])->name('ejecutar.consulta');

//Route::get('/ejecutar',[MigradorController::class,"ejecutarConsulta"])->name('ejecutar.consulta');

Route::get('/migradorsqlserver', [MigradorController::class, 'mostrarDBSqlServer'])->name('mostrar.SqlServer');

Route::get('/migradormysql', [MigradorController::class, 'mostrarDBMySQL'])->name('mostrar.MySql');
>>>>>>> Stashed changes
