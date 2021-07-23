<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('masuk');
Route::post('/masuk', 'Auth\LoginController@login')->name('masuk');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'dashboard\DashboardController@index')->name('dashboard');

    Route::get('petugas', 'petugas\PetugasController@index')->name('petugas');
    Route::any('petugas_data', 'petugas\PetugasController@data')->name('petugas_data');
    Route::any('petugas_store', 'petugas\PetugasController@store')->name('petugas_store');
    Route::any('petugas_update', 'petugas\PetugasController@update')->name('petugas_update');
    Route::any('petugas_destroy', 'petugas\PetugasController@destroy')->name('petugas_destroy');
    Route::any('petugas_pdf', 'petugas\PetugasController@pdf')->name('petugas_pdf');
    Route::any('petugas_pdf_detail/{id}', 'petugas\PetugasController@pdf_detail')->name('petugas_pdf_detail');

    Route::get('barang', 'barang\BarangController@index')->name('barang');
    Route::any('barang_data', 'barang\BarangController@data')->name('barang_data');
    Route::any('barang_store', 'barang\BarangController@store')->name('barang_store');
    Route::any('barang_update', 'barang\BarangController@update')->name('barang_update');
    Route::any('barang_destroy', 'barang\BarangController@destroy')->name('barang_destroy');
    Route::any('barang_pdf', 'barang\BarangController@pdf')->name('barang_pdf');
    Route::any('barang_pdf_filter', 'barang\BarangController@pdf_filter')->name('barang_pdf_filter');
    Route::any('barang_chart', 'barang\BarangController@chart')->name('barang_chart');

    Route::get('jadwal', 'jadwal\JadwalController@index')->name('jadwal');
    Route::any('jadwal_data', 'jadwal\JadwalController@data')->name('jadwal_data');
    Route::any('jadwal_store', 'jadwal\JadwalController@store')->name('jadwal_store');
    Route::any('jadwal_update', 'jadwal\JadwalController@update')->name('jadwal_update');
    Route::any('jadwal_destroy', 'jadwal\JadwalController@destroy')->name('jadwal_destroy');
    Route::any('jadwal_pdf', 'jadwal\JadwalController@pdf')->name('jadwal_pdf');
    Route::any('jadwal_pdf_filter', 'jadwal\JadwalController@pdf_filter')->name('jadwal_pdf_filter');
    Route::any('jadwal_pdf_filter_bulan', 'jadwal\JadwalController@pdf_filter_bulan')->name('jadwal_pdf_filter_bulan');
    Route::any('jadwal_chart', 'jadwal\JadwalController@chart')->name('jadwal_chart');

    Route::get('permohonan', 'permohonan\PermohonanController@index')->name('permohonan');
    Route::any('permohonan_data', 'permohonan\PermohonanController@data')->name('permohonan_data');
    Route::any('permohonan_store', 'permohonan\PermohonanController@store')->name('permohonan_store');
    Route::any('permohonan_update', 'permohonan\PermohonanController@update')->name('permohonan_update');
    Route::any('permohonan_destroy', 'permohonan\PermohonanController@destroy')->name('permohonan_destroy');
    Route::any('permohonan_pdf', 'permohonan\PermohonanController@pdf')->name('permohonan_pdf');
    Route::any('permohonan_pdf_filter', 'permohonan\PermohonanController@pdf_filter')->name('permohonan_pdf_filter');
    Route::any('permohonan_pdf_filter_bulan', 'permohonan\PermohonanController@pdf_filter_bulan')->name('permohonan_pdf_filter_bulan');
    Route::any('permohonan_chart', 'permohonan\PermohonanController@chart')->name('permohonan_chart');

    Route::get('kliping', 'kliping\KlipingController@index')->name('kliping');
    Route::any('kliping_data', 'kliping\KlipingController@data')->name('kliping_data');
    Route::any('kliping_store', 'kliping\KlipingController@store')->name('kliping_store');
    Route::any('kliping_update', 'kliping\KlipingController@update')->name('kliping_update');
    Route::any('kliping_destroy', 'kliping\KlipingController@destroy')->name('kliping_destroy');
    Route::any('kliping_pdf', 'kliping\KlipingController@pdf')->name('kliping_pdf');
    Route::any('kliping_pdf_filter', 'kliping\KlipingController@pdf_filter')->name('kliping_pdf_filter');
    Route::any('kliping_pdf_filter_bulan', 'kliping\KlipingController@pdf_filter_bulan')->name('kliping_pdf_filter_bulan');
    Route::any('kliping_chart', 'kliping\KlipingController@chart')->name('kliping_chart');

    Route::get('foto', 'foto\FotoController@index')->name('foto');
    Route::any('foto_data', 'foto\FotoController@data')->name('foto_data');
    Route::any('foto_store', 'foto\FotoController@store')->name('foto_store');
    Route::any('foto_update', 'foto\FotoController@update')->name('foto_update');
    Route::any('foto_destroy', 'foto\FotoController@destroy')->name('foto_destroy');
    Route::any('foto_show', 'foto\FotoController@show')->name('foto_show');
    Route::any('foto_download/{id}', 'foto\FotoController@download')->name('foto_download');
    Route::any('foto_pdf', 'foto\FotoController@pdf')->name('foto_pdf');
    Route::any('foto_pdf_filter', 'foto\FotoController@pdf_filter')->name('foto_pdf_filter');
    Route::any('foto_pdf_filter_bulan', 'foto\FotoController@pdf_filter_bulan')->name('foto_pdf_filter_bulan');
    Route::any('foto_chart', 'foto\FotoController@chart')->name('foto_chart');


    Route::get('video', 'video\VideoController@index')->name('video');
    Route::any('video_data', 'video\VideoController@data')->name('video_data');
    Route::any('video_store', 'video\VideoController@store')->name('video_store');
    Route::any('video_update', 'video\VideoController@update')->name('video_update');
    Route::any('video_destroy', 'video\VideoController@destroy')->name('video_destroy');
    Route::any('video_show', 'video\VideoController@show')->name('video_show');
    Route::any('video_download/{id}', 'video\VideoController@download')->name('video_download');
    Route::any('video_pdf', 'video\VideoController@pdf')->name('video_pdf');
    Route::any('video_pdf_filter', 'video\VideoController@pdf_filter')->name('video_pdf_filter');
    Route::any('video_pdf_filter_bulan', 'video\VideoController@pdf_filter_bulan')->name('video_pdf_filter_bulan');
    Route::any('video_chart', 'video\VideoController@chart')->name('video_chart');

    Route::get('video_jadi', 'video\VideoJadiController@index')->name('video_jadi');
    Route::any('video_jadi_data', 'video\VideoJadiController@data')->name('video_jadi_data');
    Route::any('video_jadi_store', 'video\VideoJadiController@store')->name('video_jadi_store');
    Route::any('video_jadi_update', 'video\VideoJadiController@update')->name('video_jadi_update');
    Route::any('video_jadi_destroy', 'video\VideoJadiController@destroy')->name('video_jadi_destroy');
    Route::any('video_jadi_show', 'video\VideoJadiController@show')->name('video_jadi_show');
    Route::any('video_jadi_download/{id}', 'video\VideoJadiController@download')->name('video_jadi_download');
    Route::any('video_jadi_pdf', 'video\VideoJadiController@pdf')->name('video_jadi_pdf');
    Route::any('video_jadi_pdf_filter', 'video\VideoJadiController@pdf_filter')->name('video_jadi_pdf_filter');
    Route::any('video_jadi_pdf_filter_bulan', 'video\VideoJadiController@pdf_filter_bulan')->name('video_jadi_pdf_filter_bulan');
    Route::any('video_jadi_chart', 'video\VideoJadiController@chart')->name('video_jadi_chart');




    Route::get('user', 'user\UserController@index')->name('user');
    Route::get('user_tambah', 'user\UserController@index_tambah')->name('user_tambah');
    Route::get('user_edit/{id}', 'user\UserController@index_edit')->name('user_edit');
    Route::get('ubah_password', 'user\UserController@ubah_password')->name('ubah_password');
    Route::any('user_store', 'user\UserController@store')->name('user_store');
    Route::any('user_update', 'user\UserController@update')->name('user_update');
    Route::any('ubah', 'user\UserController@update_user')->name('ubah');
    Route::get('user_hapus/{id}', 'user\UserController@hapus')->name('user_hapus');


    Route::get('logout', 'otentikasi\OtentikasiController@logout')->name('logout');
});
