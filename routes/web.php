<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;

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
    return 'API UAS SOA UEU';
});

//endpoint register new user
Route::post('/register', [UserController::class, 'register']);
//endpoint login user
Route::post('/login', [UserController::class, 'login']);

//middleware need authorization bearer and limit 20 request on 1 minute
Route::group(['middleware' => ['jwtbearer','throttle:20,1']], function () {
    //endpoint get my profile
    Route::get('/profile', [UserController::class, 'profile']);
    //endpoint update user
    Route::post('/user/{id}/update', [UserController::class, 'update_user']);
    //endpoint get all users
    Route::get('/users', [UserController::class, 'all_users']);

    //endpoint create attendance
    Route::post('/absensi', [AbsensiController::class, 'create']);
    //endpoint get list attendance
    Route::get('/absensi', [AbsensiController::class, 'list_absensi']);
});
