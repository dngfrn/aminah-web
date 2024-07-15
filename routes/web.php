<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemodalController;
use App\Http\Controllers\pemodal\PemodalController as PemodalSubController;
use App\Http\Controllers\PengajuanController;

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

Auth::routes();

// Route::get('/', function () {
//     return redirect()->route('home');
// });

Route::get('/', 'DashboardController@index')->name('indexPage');
Route::get('/daftar-usaha', 'DashboardController@listUsaha')->name('listUsaha');
Route::get('/formulir-pendanaan', 'DashboardController@formulirPendanaan')->name('formulirPendanaan');
Route::post('/formulir-pendanaan', 'DashboardController@sendFormulirPendanaan')->name('sendFormulirPendanaan');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'users', 'as' => "users.", 'controller' => UserController::class], function () {
        Route::get("/", 'index')->name("index");
        Route::post('/show', 'show')->name('show');
        Route::get('/add', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/get-list-user', 'listUser')->name('listUser');
    });
    Route::group(['prefix' => 'pemodal', 'as' => 'pemodal.'], function () {
        Route::group(['controller' => PemodalController::class], function () {
            Route::get("/", 'index')->name("index");
            Route::post('/show', 'show')->name('show');
            Route::get('/add', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
        Route::group(['controller' => PemodalSubController::class], function () {
            Route::get("/sub", 'index')->name("subIndex");
            Route::get('/sub/show/{id}', 'show')->name('subShow');
            Route::post('/sub/store', 'store')->name('subStore');
            Route::get('/sub/showpembelian/{id}', 'showpembelian')->name('subShowPembelian');
            Route::post('/sub/beli', 'pendanaan')->name('subStorePendanaan');
            Route::get('/sub/pendanaan', 'indexPendanaan')->name('subIndexPendanaan');
            Route::get('/sub/setoran/{id}', 'indexSetoran')->name('subIndexSetoran');
            Route::post('/sub/upload/{id}', 'uploadBukti')->name('subUploadBukti');
            Route::get('/sub/showpenarikan/{id}', 'indexPenarikan')->name('subIndexPenarikan');
            Route::post('/sub/penarikan/{id}', 'storePenarikan')->name('subPenarikan');
            // Route::get('/sub/add', 'create')->name('subCreate'); // Dihapus karena metode create tidak ada
            Route::get('/sub/edit/{id}', 'edit')->name('subEdit');
            Route::put('/sub/update/{id}', 'update')->name('subUpdate');
            Route::get('/sub/destroy/{id}', 'destroy')->name('subDestroy');
        });
    });
    Route::resource('pengajuan', PengajuanController::class);
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::post('/approve-pengajuan/{id}', 'PengajuanController@approvePengajuan')->name('approvePengajuan');
    });
    Route::group(['prefix' => 'pemilik-usaha', 'as' => 'pemilikUsaha.'], function () {
        Route::get('/profile', 'PemilikUsahaController@showProfile')->name('profile');
        Route::put('/profile', 'PemilikUsahaController@updateProfile')->name('profileUpdate');
        Route::post('/terima-pendanaan', 'PemilikUsahaController@receivePendanaan')->name('receivePendanaan');
        Route::post('/setor-pendanaan', 'PemilikUsahaController@sendPendanaan')->name('sendPendanaan');
    });
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
        Route::get('/keuangan-pelaku-usaha', 'AdminController@showKeuanganPelakuUsaha')->name('showKeuanganPelakuUsaha');
        Route::post('/transfer-pelaku-usaha/{id}', 'AdminController@updateTransferedPelakuUsaha')->name('updateTransferedPelakuUsaha');
        Route::post('/complete-pelaku-usaha/{id}', 'AdminController@updateDonePelakuUsaha')->name('updateDonePelakuUsaha');
        Route::get('/keuangan-pemodal', 'AdminController@showKeuanganPemodal')->name('showKeuanganPemodal');
        Route::post('/accept-pemodal-transfer/{id}', 'AdminController@acceptPemodalTransfer')->name('acceptPemodalTransfer');
        Route::post('/reject-pemodal-transfer/{id}', 'AdminController@rejectPemodalTransfer')->name('rejectPemodalTransfer');
        Route::post('/pemodal-transfered/{id}', 'AdminController@PemodalTransfered')->name('PemodalTransfered');
    });
});
// Route::group(['middleware' => ['auth', 'role:admin']], function () {
//     Route::controller(KaryawanController::class)->group(function () {
//         Route::post('/', 'index')->name('karyawan');
//     });
// });
