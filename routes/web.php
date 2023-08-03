<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\RincianPembayaranController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\LaporanKeuanganController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\KategoriPelanggaranController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\CekPelanggaranController;
use App\Http\Controllers\Admin\LaporanPelanggaranController;

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
    return view('login');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::post('/loginproses', [App\Http\Controllers\LoginController::class, 'loginproses'])->name('loginproses');


Route::group(['middleware' => ['auth', 'ceklevel:admin,Bendahara,BK']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/data-akun', AkunController::class);
    Route::get('/gantipassword', [AkunController::class, 'gantipassword'])->name('gantipassword');
    Route::get('/logout', [AkunController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::resource('/data-siswa', SiswaController::class);

    Route::get('/carisiswa', [SiswaController::class, 'carisiswa'])->name('carisiswa');

    Route::resource('/data-kelas', KelasController::class);
    Route::get('/carikelas', [KelasController::class, 'carikelas'])->name('carikelas');
    Route::get('/detailkelas', [KelasController::class, 'detailkelas'])->name('detailkelas');

    Route::get('/naikkelas', [KelasController::class, 'naikkelas'])->name('naikkelas');

    Route::resource('/data-user', UserController::class);
    Route::get('/cariuser', [UserController::class, 'cariuser'])->name('cariuser');

    Route::resource('/data-tahunakademik', TahunAkademikController::class);
    Route::get('/caritahun', [TahunAkademikController::class, 'caritahun'])->name('caritahun');
});
Route::group(['middleware' => ['auth', 'ceklevel:Bendahara,admin']], function () {

    Route::resource('/data-rincian-pembayaran', RincianPembayaranController::class);
    Route::get('/caririncian', [RincianPembayaranController::class, 'caririncian'])->name('caririncian');

    Route::resource('/data-pembayaran', PembayaranController::class);
    Route::get('/pilihsiswa/{id}', [PembayaranController::class, 'pilihsiswa'])->where("id", "[0-9]+");

    Route::get('/carinisn', [PembayaranController::class, 'carinisn'])->name('carinisn');

    Route::get('/tampil', [PembayaranController::class, 'tampil'])->name('tampil');
    Route::get('/caritahunkelas', [PembayaranController::class, 'caritahunkelas'])->name('caritahunkelas');

    Route::get('/cekpembayaran', [PembayaranController::class, 'cekpembayaran'])->name('cekpembayaran');
    Route::get('/caripembayaran', [PembayaranController::class, 'caripembayaran'])->name('caripembayaran');

    Route::get('/cart/tambah/{id}', [PembayaranController::class, 'do_tambah_cart'])->where("id", "[0-9]+");
    Route::get('/cart', [PembayaranController::class, 'cart'])->name('cart');
    Route::get('/cart/hapus/{id}', [PembayaranController::class, 'do_hapus_cart'])->where("id", "[0-9]+");

    Route::get('/cetak', [PembayaranController::class, 'cetak'])->name('cetak');
    Route::get('/cetaksemua', [PembayaranController::class, 'cetaksemua'])->name('cetaksemua');



    Route::resource('/laporan-keuangan', LaporanKeuanganController::class);
    Route::get('/carilaporan', [LaporanKeuanganController::class, 'carilaporan'])->name('carilaporan');
    Route::get('/cetakkeuangan/{tahun}/{kelas}', [LaporanKeuanganController::class, 'cetakkeuangan'])->name('cetakkeuangan');
});
Route::group(['middleware' => ['auth', 'ceklevel:BK,admin']], function () {
    Route::resource('/kategori-pelanggaran', KategoriPelanggaranController::class);

    Route::resource('/pelanggaran', PelanggaranController::class);
    Route::get('/carikasus', [PelanggaranController::class, 'carikasus'])->name('carikasus');
    Route::get('/pilih_siswa/{id}', [PelanggaranController::class, 'pilih_siswa'])->where("id", "[0-9]+");





    Route::get('/cekpelanggaran', [PelanggaranController::class, 'cekpelanggaran'])->name('cekpelanggaran');


    Route::get('/caripelanggaran', [CekPelanggaranController::class, 'caripelanggaran'])->name('caripelanggaran');
    Route::get('/tampilsiswa', [PelanggaranController::class, 'tampilsiswa'])->name('tampilsiswa');

    Route::get('/cetakrincianpelanggaran', [PelanggaranController::class, 'cetakrincianpelanggaran'])->name('cetakrincianpelanggaran');
    Route::get('/cetakpelanggaran', [LaporanPelanggaranController::class, 'cetakpelanggaran'])->name('cetakpelanggaran');

    Route::get('/cetaksemuapelanggaran', [LaporanPelanggaranController::class, 'cetaksemuapelanggaran'])->name('cetaksemuapelanggaran');

    Route::get('/cetakkeuangan', [LaporanKeuanganController::class, 'cetakkeuangan'])->name('cetakkeuangan');

    Route::resource('/laporan-pelanggaran', LaporanPelanggaranController::class);
});
