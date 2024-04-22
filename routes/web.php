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
    if(session()->has('login')){
        return redirect('/home');
    }
    return redirect('login');
});

Route::get('/login', [loginController::class, 'show'])->name('login');
Route::post('/login',[loginController::class,'handle'])->name('login.submit');
Route::post('/logout',[loginController::class,'logout'])->name('logout');

//Auth::routes();
Route::get('/home',[MainController::class,'index']);
Route::get('delete/{nrproc}', [MainController::class, 'destroy']);

Route::get('/tambah',[MainController::class,'insert']);
Route::get('tambah/{nrproc}',[MainController::class,'store']);
Route::get('/search',[MainController::class,'search']);


Route::get('/logs', [AktivitiController::class, 'index']);


