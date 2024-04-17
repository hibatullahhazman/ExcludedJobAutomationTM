<?php

use App\Http\Controllers\AktivitiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isLogin;

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

Route::get('/', function () {
    return view('welcome');
});

/*Route::middleware(['basicauth'])->group(function () {
    //All the routes are placed in here
    //Route::get('/', [loginController::class, 'show'])->name('login');
    Route::get('/test',[MainController::class,'test']);
});*/

Route::get('/login', [loginController::class, 'show'])->name('login');
Route::post('/login',[loginController::class,'handle'])->name('login.submit');
Route::post('/logout',[loginController::class,'logout'])->name('logout');

//Auth::routes();
Route::get('/home',[MainController::class,'index']);
Route::get('delete/{nrproc}', [MainController::class, 'destroy']);

Route::get('/tambah',[MainController::class,'insert']);
Route::get('tambah/{nrproc}',[MainController::class,'store']);
Route::get('/search',[MainController::class,'search']);


Route::get('/aktiviti', [AktivitiController::class, 'index']);


