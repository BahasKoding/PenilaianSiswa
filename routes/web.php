<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MengajarController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[LandingController::class,'index']);
Route::get('/login',[LoginController::class,'login'])->middleware('guest')->name('login');
Route::post('/login',[LoginController::class,'auth']);
Route::get('/dashboard',[LoginController::class,'dashboard'])->middleware('auth');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


// Route::get('/table/guru/index', function (){
//     return view('table.guru.index');
// });




// guru, mapel, jurusan, kelas, siswa, mengajar

Route::prefix('/table')->group(function(){
    Route::get('/guru/index',[GuruController::class,'index']);
    Route::get('/guru/create',[GuruController::class,'create']);
    Route::post('/guru/store',[GuruController::class,'store']);
    Route::get('/guru/edit/{guru}',[GuruController::class,'edit']);
    Route::post('/guru/update/{guru}',[GuruController::class,'update']);
    Route::post('/guru/destroy/{guru}',[GuruController::class,'destroy']);
});

Route::prefix('/table')->group(function(){
    Route::get('/mapel/index',[MapelController::class,'index']);
    Route::get('/mapel/create',[MapelController::class,'create']);
    Route::post('/mapel/store',[MapelController::class,'store']);
    Route::get('/mapel/edit/{mapel}',[MapelController::class,'edit']);
    Route::post('/mapel/update/{mapel}',[MapelController::class,'update']);
    Route::post('/mapel/destroy/{mapel}',[MapelController::class,'destroy']);
});

Route::prefix('/table')->group(function(){
    Route::get('/jurusan/index',[JurusanController::class,'index']);
    Route::get('/jurusan/create',[JurusanController::class,'create']);
    Route::post('/jurusan/store',[JurusanController::class,'store']);
    Route::get('/jurusan/edit/{jurusan}',[JurusanController::class,'edit']);
    Route::post('/jurusan/update/{jurusan}',[JurusanController::class,'update']);
    Route::post('/jurusan/destroy/{jurusan}',[JurusanController::class,'destroy']);
});

Route::prefix('/table')->group(function(){
    Route::get('/kelas/index',[KelasController::class,'index']);
    Route::get('/kelas/create',[KelasController::class,'create']);
    Route::post('/kelas/store',[KelasController::class,'store']);
    Route::get('/kelas/edit/{kelas}',[KelasController::class,'edit']);
    Route::post('/kelas/update/{kelas}',[KelasController::class,'update']);
    Route::post('/kelas/destroy/{kelas}',[KelasController::class,'destroy']);
});

Route::prefix('/table')->group(function(){
    Route::get('/siswa/index',[SiswaController::class,'index']);
    Route::get('/siswa/create',[SiswaController::class,'create']);
    Route::post('/siswa/store',[SiswaController::class,'store']);
    Route::get('/siswa/edit/{siswa}',[SiswaController::class,'edit']);
    Route::post('/siswa/update/{siswa}',[SiswaController::class,'update']);
    Route::post('/siswa/destroy/{siswa}',[SiswaController::class,'destroy']);
});

Route::prefix('/table')->group(function(){
    Route::get('/mengajar/index',[MengajarController::class,'index']);
    Route::get('/mengajar/create',[MengajarController::class,'create']);
    Route::post('/mengajar/store',[MengajarController::class,'store']);
    Route::get('/mengajar/edit/{mengajar}',[MengajarController::class,'edit']);
    Route::post('/mengajar/update/{mengajar}',[MengajarController::class,'update']);
    Route::post('/mengajar/destroy/{mengajar}',[MengajarController::class,'destroy']);
});