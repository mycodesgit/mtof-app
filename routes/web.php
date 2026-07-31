<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicantController;

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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/login', [LoginController::class,'index'])->name('login.index');
    Route::post('/login/success', [LoginController::class,'storelogin'])->name('login.store');
});

Route::group(['middleware'=>['login_empauth']],function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::prefix('/applicants')->group(function () {
        Route::get('/list/view', [ApplicantController::class,'index'])->name('applicant.index');
        Route::get('/list/view/fetch', [ApplicantController::class,'show'])->name('applicant.show');
    });
});
