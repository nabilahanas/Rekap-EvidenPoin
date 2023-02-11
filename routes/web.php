<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Middleware\CekLevel;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\EvdataController;
use App\Http\Controllers\HarianController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\RekapBidang1Controller;
use App\Http\Controllers\RekapBidangController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', 'AuthController@register');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/registered', [AuthController::class, 'registered'])->name('registered');

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=>['auth']], function () {
    Route::get('/home', [NavController::class, 'home'])->name('home');
    // Route::get('/profile', [NavController::class, 'profile'])->name('profile');
    
    Route::get('/searchuser', [NavController::class, 'searchuser'])->name('searchuser');

    Route ::prefix("profile")->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    });


    //CRUD USER TABLE
    // Route::get('/user', [UserController::class, 'index'])->name('user.index');
    // Route::post('/user/{id}', [UserController::class, 'edit'])->name('user.edit');
    // Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    // Route::post('/user/{id}', [UserController::class, 'delete'])->name('user.delete');


    Route ::prefix("user")->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('search', [UserController::class, 'search'])->name('search');
        Route::get('add', [AuthController::class, 'register'])->name('register');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::post('recycle/{id}', [UserController::class, 'recycle'])->name('user.recycle');
        Route::get('restore/{id}', [UserController::class, 'restore'])->name('user.restore');
        });
    
    
        Route ::prefix("evdata")->group(function(){
            Route::get('/', [EvdataController::class, 'index'])->name('evdata.index');
            Route::get('add', [EvdataController::class, 'create'])->name('evdata.add');
            Route::post('store', [EvdataController::class, 'store'])->name('evdata.store');
            Route::get('edit/{id}', [EvdataController::class, 'edit'])->name('evdata.edit');
            Route::post('update/{id}', [EvdataController::class, 'update'])->name('evdata.update');
            Route::post('delete/{id}', [EvdataController::class, 'delete'])->name('evdata.delete');
            Route::post('recycle/{id}', [EvdataController::class, 'recycle'])->name('evdata.recycle');
            Route::get('restore/{id}', [EvdataController::class, 'restore'])->name('evdata.restore');
            });
    
    Route::get('/rekapdata', [NavController::class, 'rekapdata'])->name('rekapdata');
    Route::get('/rekapdata/harian', [HarianController::class, 'harian'])->name('harian');
    Route::get('/rekapdata/rekapbidang1', [RekapBidang1Controller::class, 'rekapbidang1'])->name('rekapbidang1');
    Route::get('/rekapdata/rekapbidang', [RekapBidangController::class, 'rekapbidang'])->name('rekapbidang');
    Route::get('/rekapdata/rekap', [RekapController::class, 'rekap'])->name('rekap');
    Route::get('/rekapdata/grafik', [GrafikController::class, 'grafik'])->name('grafik');
});
