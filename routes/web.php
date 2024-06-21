<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
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

Route::get('/', [\App\Http\Controllers\User\UserController::class, 'index']);
Route::get('/pengaduan',  [\App\Http\Controllers\User\UserController::class, 'pengaduan'])->name('pengaduan');
Route::post('/pengaduan/kirim',  [\App\Http\Controllers\User\UserController::class, 'storePengaduan'])->name('pengaduan.store');

Route::middleware('auth:masyarakat')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\User\UserController::class, 'profile'])->name('user.profile');
    Route::post('/update-profile', [\App\Http\Controllers\User\UserController::class, 'updateProfile'])->name('user.updateProfile');
});

Route::get('/login',  [\App\Http\Controllers\User\UserController::class, 'masuk']);
Route::get('/register',  [\App\Http\Controllers\User\UserController::class, 'daftar']);
Route::get('/tentang',  [\App\Http\Controllers\User\UserController::class, 'tentang']);

Route::middleware(['guest'])->group(function () {
    // Login Masyarakat
    Route::get('/login',  [\App\Http\Controllers\User\UserController::class, 'masuk'])->name('user.masuk');
    Route::post('/login/auth', [\App\Http\Controllers\User\UserController::class, 'login'])->name('user.login');

    // Register
    Route::get('/register', [\App\Http\Controllers\User\UserController::class, 'register'])->name('user.register');
    Route::post('/getdesa', [\App\Http\Controllers\IndoRegionController::class, 'getDesa'])->name('getdesa');
    Route::post('/getkota', [\App\Http\Controllers\IndoRegionController::class, 'getKota'])->name('getkota');
    Route::post('/getkecamatan', [\App\Http\Controllers\IndoRegionController::class, 'getKecamatan'])->name('getkecamatan');
    Route::get('/getprovinces', [\App\Http\Controllers\IndoRegionController::class, 'getProvinces'])->name('getprovinces');
    Route::post('/register/auth', [\App\Http\Controllers\User\UserController::class, 'register_post'])->name('user.register-post');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware(['isMasyarakat'])->group(function () {
    // Logout Masyarakat
    Route::get('/logout', [\App\Http\Controllers\User\UserController::class, 'logout'])->name('user.logout');

    Route::get('/laporan/{who?}', [\App\Http\Controllers\User\UserController::class, 'laporan'])->name('pengaduan.laporan');
    Route::get('/pengaduan-detail/{id_pengaduan}', [\App\Http\Controllers\User\UserController::class, 'detailPengaduan'])->name('pengaduan.detail');
});

Route::prefix('admin')->group(function() {
    Route::middleware('isGuest')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'formLogin'])->name('admin.masuk');
        Route::post('/login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    });

    Route::middleware('isAdmin')->group(function() {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/petugas', \App\Http\Controllers\Admin\PetugasController::class);
        Route::resource('/masyarakat', \App\Http\Controllers\Admin\MasyarakatController::class);

        Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
        Route::post('/laporan-get', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan'])->name('laporan.get');
        Route::post('/laporan/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('laporan.export');

        Route::prefix('perumahan')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PerumahanController::class, 'index'])->name('perumahan.index');
            Route::get('/create', [\App\Http\Controllers\Admin\PerumahanController::class, 'create'])->name('perumahan.create');
            Route::post('/store', [\App\Http\Controllers\Admin\PerumahanController::class, 'store'])->name('perumahan.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\PerumahanController::class, 'edit'])->name('perumahan.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Admin\PerumahanController::class, 'update'])->name('perumahan.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Admin\PerumahanController::class, 'destroy'])->name('perumahan.delete');
        });

        // Logout Admin
        Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware('isPetugas')->group(function() {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::get('pengaduan/{status}', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/show/{id_pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('pengaduan/delete/{id_pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'destroy'])->name('pengaduan.delete');
        // Tanggapan
        Route::post('tanggapan', [\App\Http\Controllers\Admin\TanggapanController::class, 'response'])->name('tanggapan');

        // Logout Petugas
        Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    });


});


