<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminRoleController;

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

Route::get('/', [AdminDiagnosaController::class, 'index']);



Route::prefix('/admin/auth')->group(function () {
    Route::get('/', [AdminAuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/register', [AdminAuthController::class, 'register']);
    Route::post('/doRegister', [AdminAuthController::class, 'doRegsiter']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});

Route::get('/admin/dashboard', function () {
    $data = [
        'content' => 'admin/dashboard/index'
    ];
    return view('admin/layouts/wrapper', $data);
});

Route::prefix('/admin/diagnosa')->group(function () {
    Route::get('/', [AdminDiagnosaController::class, 'index']);
    Route::get('/periksa', [AdminDiagnosaController::class, 'periksa']);
    Route::get('/pilih', [AdminDiagnosaController::class, 'pilih']);
    Route::get('/delete', [AdminDiagnosaController::class, 'delete']);
    Route::get('/proses', [AdminDiagnosaController::class, 'proses']);
    Route::get('/result', [AdminDiagnosaController::class, 'result']);
    Route::post('/pasien/create', [AdminDiagnosaController::class, 'createPasien']);
});


Route::prefix('/admin')->middleware('auth')->group(function () {


    Route::resource('/user', AdminUserController::class);

    Route::get('/konfigurasi', [AdminConfigurationController::class, 'index']);
    Route::put('/konfigurasi/update', [AdminConfigurationController::class, 'update']);

    Route::get('/pasien', [AdminPasienController::class, 'index']);
    Route::get('/pasien/detail/{id}', [AdminPasienController::class, 'detail']);
    Route::get('/pasien/print/{id}', [AdminPasienController::class, 'print']);

    Route::resource('/banner', AdminBannerController::class);
    Route::resource('/gejala', AdminGejalaController::class);
    Route::resource('/penyakit', AdminPenyakitController::class);

    Route::post('/role/create', [AdminRoleController::class, 'create']);
    Route::get('/role/delete', [AdminRoleController::class, 'delete']);



    Route::prefix('/posts')->group(function () {
        Route::resource('/post', AdminPostController::class);
        Route::resource('/kategori', AdminCategoryPostController::class);
    });
});

Route::prefix('/home')->group(function () {
    // Route::resource('/mitra', HomeMitraController::class);;
    // Route::resource('/layanan', HomeLayananController::class);;
});
