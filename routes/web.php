<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HR\KaryawanController;
use App\Http\Controllers\InvoiceContorller;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IzinSakitController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\UserPermissionController;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::middleware(['auth', 'permission:view-dashboard'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/rekanan', 'RekananController@index')->name('rekanan.index');
Route::get('/rekanan-create', [RekananController::class, 'viewCreate'])->name('rekanan.create');
Route::post('/rekanan-create', [RekananController::class, 'create'])->name('rekanan.store');
Route::get('/rekanans/{rekanan}/edit', [RekananController::class, 'viewEdit'])->name('rekanan.edit');
Route::put('/rekanans/{rekanan}', [RekananController::class, 'update'])->name('rekanan.update');

Route::get('/hr-karyawan', [KaryawanController::class, 'karyawanIndex'])->name('karyawan.index');
Route::get('/hr-karyawan-create', [KaryawanController::class, 'viewCreate'])->name('karyawan.create.view');
// Route::post('/hr-karyawan-add', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::post('/hr-karyawan-add-karyawan', [KaryawanController::class, 'storeUser'])->name('karyawan.store');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}/edit', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/karyawan/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
Route::DELETE('/karyawan/{id}/delete', [KaryawanController::class, 'delete'])->name('karyawan.destroy');

Route::get('/pengajuan-cuti', [CutiController::class, 'index'])->name('pengajuan.cuti.index');
Route::post('/pengajuan-cuti', [CutiController::class, 'store'])->name('pengajuan-cuti.store');

Route::get('/pengajuan-izin-sakit', [IzinSakitController::class, 'index'])->name('pengajuan.izin-sakit.index');
Route::post('/pengajuan-izin-sakit', [IzinSakitController::class, 'store'])->name('pengajuan-izin-sakit.store');

Route::get('/admin-permission', [PermissionController::class, 'index'])->name('admin.permission.index');

Route::get('/admin/user-permissions', [UserPermissionController::class, 'index'])->name('admin.user_permissions.index');
Route::post('/admin/user-permissions/update/{userId}', [UserPermissionController::class, 'update'])->name('admin.user_permissions.update');

Route::get('/invoice-management',[InvoiceController::class, 'index'])->name('marketing.invoice.index');

Route::get('/order-management',[OrderController::class, 'index'])->name('marketing.order.index');
Route::post('/order-create', [OrderController::class, 'store'])->name('orders.store');


Route::get('/op-kendaraan', [OperasionalController::class, 'index'])->name('kendaraan.index');
Route::post('/op-kendaraan-add', [OperasionalController::class, 'store'])->name('kendaraan.store');

Route::get('/op-intruksiJalan', [OperasionalController::class, 'instruksiJalanIndex'])->name('intruksiJalan.index');
Route::post('/op-intruksiJalan-create', [OperasionalController::class, 'instruksiStore'])->name('instruksi_jalan.store');

Route::get('/op-service-kendaraan', [OperasionalController::class, 'indexService'])->name('service.index');
Route::post('/op-service-kendaraan', [OperasionalController::class, 'createService'])->name('service-kendaraan.store');


Route::get('/about', function () {
    return view('about');
})->name('about');
