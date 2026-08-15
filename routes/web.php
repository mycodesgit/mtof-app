<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AccountSettingController;

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
        Route::get('/list/view/modal/{id}', [ApplicantController::class,'view'])->name('applicant.view');
        Route::get('/list/view/modal/file/f1/{id}', [ApplicantController::class,'viewPDFform1'])->name('applicant.viewPDFform1');
        Route::get('/list/view/modal/file/f2/{id}', [ApplicantController::class,'viewPDFform2'])->name('applicant.viewPDFform2');
        Route::get('/list/view/modal/file/f3/{id}', [ApplicantController::class,'viewPDFform3'])->name('applicant.viewPDFform3');
        Route::get('/list/view/modal/file/aou1/{id}', [ApplicantController::class,'viewPDFaou1'])->name('applicant.viewPDFaou1');
        Route::get('/list/view/modal/file/aou2/{id}', [ApplicantController::class,'viewPDFaou2'])->name('applicant.viewPDFaou2');
        Route::get('/applicant/documents/{id}', [ApplicantController::class, 'getApplicantDocs'])->name('applicant.docs.get');
        Route::post('/applicant/documents/store', [ApplicantController::class, 'storeApplicantDocs'])->name('applicant.docs.store');
    });

    Route::prefix('/signatories')->group(function () {
        Route::get('/list/view', [SignatoryController::class,'index'])->name('signatory.index');
        Route::get('/list/view/fetch', [SignatoryController::class,'show'])->name('signatory.show');
    });
    
    Route::prefix('/signatories')->group(function () {
        Route::get('/list/view', [SignatoryController::class,'index'])->name('signatory.index');
        Route::get('/list/view/fetch', [SignatoryController::class,'show'])->name('signatory.show');
    });

    Route::prefix('/docs')->group(function () {
        Route::get('/list/view', [DocumentController::class,'index'])->name('document.index');
        Route::get('/list/view/fetch', [DocumentController::class,'show'])->name('document.show');
        Route::post('/list/view/store', [DocumentController::class,'store'])->name('document.store');
    });

    Route::prefix('/system')->group(function () {
        Route::get('/setting/view', [SettingsController::class,'index'])->name('settings.index');
    });
    
    Route::prefix('/account')->group(function () {
        Route::get('/setting/preview', [AccountSettingController::class,'index'])->name('accountseting.index');
    });
});
