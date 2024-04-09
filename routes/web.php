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


Route::get('/vista-migrador', [MigradorController::class, 'mostrarVista'])->name('mostrar.Vista');

Route::post('/convertir-json', [MigradorController::class, 'convertirJsonSqlServer'])->name('convertir.Json.SqlServer');

Route::get('/ejecutar/{database}/{consulta}',[MigradorController::class,"ejecutarConsultaSqlServer"])->name('ejecutar.Consulta.SqlServer');

Route::post('/migrar-bd',[MigradorController::class,"migrarBDSqlServer"])->name('migrar.BD.SqlServer');


Route::get('/migradorsqlserver', [MigradorController::class, 'mostrarDBSqlServer'])->name('mostrar.SqlServer');

Route::get('/migradormysql', [MigradorController::class, 'mostrarDBMySQL'])->name('mostrar.MySql');

Route::post('/convertir-json-mysql', [MigradorController::class, 'convertirJsonMySql'])->name('convertir.Json.MySql');

Route::post('/migrar-bd-mysql',[MigradorController::class,"migrarBDMySql"])->name('migrar.BD.MySql');

Route::get('/ejecutar/mysql/{database}/{consulta}',[MigradorController::class,"ejecutarConsultaMySql"])->name('ejecutar.Consulta.MySql');

# rutas de juan
Route::get('/MysqlSchema', [MysqlController::class, "obtenerSchemaDatabase"]);


