<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukPromoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WishlistController;

Route::get('/','HomepageController@index');

Route::get('/kategori','HomepageController@kategori');
Route::get('/kategori/{slug}','HomepageController@produkperkategori');
Route::get('/produk','ProdukController@produk');
Route::get('/produk/{id}','HomepageController@produkdetail');

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    Route::get('/', 'DashboardController@index');
    Route::resource('kategori','KategoriController');
    Route::resource('produk','ProdukController');
    Route::resource('customer','CustomerController');
    Route::resource('transaksi','TransaksiController');
    Route::get('profil', 'UserController@index');
    Route::get('setting', 'UserController@setting');
    Route::resource('wishlist','WishlistController');
    Route::get('laporan', 'LaporanController@index');
    Route::get('proseslaporan', 'LaporanController@proses');
    Route::post('imagekategori','KategoriController@uploadimage');
    Route::post('imagekategori/{id}','KategoriController@deleteimage');
    Route::post('produkimage','ProdukController@uploadimage');
    Route::delete('produkimage/{id}','KategoriController@deleteimage');
    Route::resource('promo','ProdukPromoController');
    Route::get('loadprodukasync/{id}','ProdukPromoController@loadasync');
    Route::resource('cartdetail','cartDetailController');
    Route::get('checkout', 'CartController@checkout');
  });




Auth::routes();
Route::get('/home',function(){
return redirect('/admin');
});
//Route::get('/home', 'HomeController@index')->name('home');
