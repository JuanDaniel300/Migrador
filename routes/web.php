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


Route::get('/migrador', [MigradorController::class, 'mostrarDBSqlServer'])->name('mostrar.SqlServer');

Route::get('/migradors', [MigradorController::class, "convertirJson"])->name('ver.migrador');

Route::get('/ejecutar', [MigradorController::class, "ejecutarConsulta"])->name('ejecuta.consulta');



# rutas de juan
Route::post('/MysqlSchema', [MysqlController::class, "obtenerSchemaDatabase"]);
