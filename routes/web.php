<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CityController;
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
use App\Http\Controllers\PICController;
use App\Http\Controllers\POController;
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
Route::delete('/rekanans/{rekanan}', [RekananController::class, 'delete'])->name('rekanan.delete');

Route::get('/pic-customer', [PICController::class, 'index'])->name('pic-index');
Route::get('/pic-customer-create', [PICController::class, 'viewCreate'])->name('pic-createView');
Route::post('/pic-customer-create', [PICController::class, 'create'])->name('pic_customer.store');
Route::get('/pic_customer/{id}/edit', [PICController::class, 'viewEdit'])->name('pic_customer.edit');
Route::put('/pic_customer/{id}', [PICController::class, 'update'])->name('pic_customer.update');
Route::delete('/pic/{pic}', [PICController::class, 'delete'])->name('pic.delete');

Route::get('/hr-karyawan', [KaryawanController::class, 'karyawanIndex'])->name('karyawan.index');
Route::get('/hr-karyawan-create', [KaryawanController::class, 'viewCreate'])->name('karyawan.create.view');
// Route::post('/hr-karyawan-add', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::post('/hr-karyawan-add-karyawan', [KaryawanController::class, 'storeUser'])->name('karyawan.store');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}/edit', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/karyawan/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

Route::get('/pengajuan-cuti', [CutiController::class, 'index'])->name('pengajuan.cuti.index');
Route::get('/create-cuti', [CutiController::class, 'createIndex'])->name('pengajuan.cuti.create');
Route::post('/pengajuan-cuti', [CutiController::class, 'store'])->name('pengajuan-cuti.store');

Route::get('/approval-cuti', [ApprovalController::class, 'index'])->name('approval.index');
Route::post('/cuti/{id}/approve', [ApprovalController::class, 'approveCuti'])->name('cuti.approve');
Route::post('/cuti/{id}/reject', [ApprovalController::class, 'rejectCuti'])->name('cuti.reject');

Route::post('/izin-sakit/{id}/approve', [ApprovalController::class, 'approveIzinSakit'])->name('izin-sakit.approve');
Route::post('/izin-sakit/{id}/reject', [ApprovalController::class, 'rejectIzinSakit'])->name('izin-sakit.reject');

Route::get('/pengajuan-izin-sakit', [IzinSakitController::class, 'index'])->name('pengajuan.izin-sakit.index');
Route::get('/create-izin-sakit', [IzinSakitController::class, 'createIndex'])->name('pengajuan.izin-sakit.create');
Route::post('/pengajuan-izin-sakit', [IzinSakitController::class, 'store'])->name('pengajuan-izin-sakit.store');

Route::get('/admin-permission', [PermissionController::class, 'index'])->name('admin.permission.index');

Route::get('/admin/user-permissions', [UserPermissionController::class, 'index'])->name('admin.user_permissions.index');
Route::post('/admin/user-permissions/update/{userId}', [UserPermissionController::class, 'update'])->name('admin.user-permissions.update');
Route::get('/admin/user-permissions/{userId}/edit', [UserPermissionController::class, 'edit'])->name('admin.user_permissions.edit');

Route::get('/invoice-management',[InvoiceController::class, 'index'])->name('marketing.invoice.index');
Route::get('/invoice-management-create', [InvoiceController::class, 'viewCreate'])->name('marketing.invoice.create');
Route::post('/invoice-management-create', [InvoiceController::class, 'store'])->name('invoices.store');

Route::get('/api/get-orders', [InvoiceController::class, 'getOrders'])->name('api.get-orders');



Route::get('/order-management',[OrderController::class, 'index'])->name('marketing.order.index');
Route::get('/order-view-create', [OrderController::class, 'viewCreate'])->name('marketing.order.viewCreate');
Route::post('/order-create', [OrderController::class, 'store'])->name('marketing.order.store');
Route::get('/fetch-term-agrement/{no_po}', [OrderController::class, 'fetchTermAgrement']);
Route::get('/fetch-orders/{noPo}', [OrderController::class, 'fetchOrders']);

Route::get('/rekanans/{id}', [OrderController::class, 'getRekanan']);


Route::get('/po-customer', [POController::class, 'index'])->name('marketing.po.index');
Route::get('/po-customer-create', [POController::class, 'viewCreate'])->name('marketing.po.create');
Route::post('/po-customer/store', [POController::class, 'store'])->name('marketing.po.store');
Route::get('/po-customer/edit/{id}', [POController::class, 'viewEdit'])->name('marketing.po.viewEdit');
Route::put('/po-customer/edit/{id}', [POController::class, 'update'])->name('marketing.po.update');
Route::delete('/po-customer/{id}', [POController::class, 'destroy'])->name('marketing.po.destroy');

Route::get('/cities', [APIController::class, 'getCities'])->name('cities');

// Route::get('/get-cities', [CityController::class, 'getCities'])->name('get.cities');

Route::get('/op-kendaraan', [OperasionalController::class, 'kendaraanIndex'])->name('kendaraan.index');
Route::get('/op-kendaraan-create', [OperasionalController::class, 'viewCreateKendaraan'])->name('kendaraan.viewCreate');
Route::post('/op-kendaraan-add', [OperasionalController::class, 'kendaraanStore'])->name('kendaraan.store');
Route::get('/op-kendaraan/{id}/edit', [OperasionalController::class, 'editKendaraan'])->name('kendaraaan.edit');
Route::put('/op-kendaraan/{id}', [OperasionalController::class, 'updateKendaraan'])->name('kendaraan.update');
Route::delete('/op-kendaraan/{id}/delete', [OperasionalController::class, 'destroyKendaraan'])->name('kendaraan.delete');

Route::get('/op-intruksiJalan', [OperasionalController::class, 'instruksiJalanIndex'])->name('intruksiJalan.index');
Route::get('/op-intruksiJalan/create', [OperasionalController::class, 'viewCreateIntruksiJalan'])->name('intruksiJalan.viewCreate');
Route::post('/op-intruksiJalan-create', [OperasionalController::class, 'instruksiStore'])->name('instruksi_jalan.store');
Route::get('/instruksi-jalan/{id}/edit', [OperasionalController::class, 'editIntruksiJalan'])->name('instruksi_jalan.edit');
Route::put('/instruksi-jalan/{id}', [OperasionalController::class, 'updateIntruksiJalan'])->name('instruksi_jalan.update');
Route::delete('/instruksi-jalan/{id}/delete', [OperasionalController::class, 'destroyIntuksiJalan'])->name('intruksiJalan.delete');

Route::get('/op-service-kendaraan', [OperasionalController::class, 'indexService'])->name('service.index');
Route::get('/op-service-kendaraan/create', [OperasionalController::class, 'viewCreate'])->name('service.viewCreate');
Route::get('/op-service-kendaraan/{id}/edit', [OperasionalController::class, 'viewEditService'])->name('service.viewEdit');
Route::put('/op-service-kendaraan/{id}', [OperasionalController::class, 'updateService'])->name('service.update');

Route::post('/op-service-kendaraan', [OperasionalController::class, 'createService'])->name('service-kendaraan.store');


Route::get('/about', function () {
    return view('about');
})->name('about');
