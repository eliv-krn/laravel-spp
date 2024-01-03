<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'proses'])->name('login');
});

Route::middleware('auth:petugas')->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/laporan', [PembayaranController::class, 'laporan'])->name('laporan');
});

Route::get('/getSiswa', [SiswaController::class, 'getSiswa']);
Route::get('/getSpp', [SppController::class, 'getSpp']);

Route::get('/getHistory', [SiswaController::class, 'getHistory'])->name('getHistory')->middleware('auth:siswa');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');

//Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//});

Route::get('/', function () {
    return redirect()->route('login');
});
