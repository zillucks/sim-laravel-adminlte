<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// CORS
header('Access-Control-Allow-Origin: http://localhost:8100');
header('Access-Control-Allow-Credentials: true');

Route::get('/', 'HomeController@index');

Route::post('/customlogin', 'HomeController@frontLogin');

Route::auth();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index');
});

/*
 * Route for administrator
 */
Route::group(['middleware' => ['auth', 'role:administrator']], function() {
	Route::group(['as' => 'setting::'], function() {
		Route::get('setting/jabatan', 'AdminController@jabatan')->name('jabatan');
		Route::get('setting/level', 'AdminController@level')->name('level');
		Route::get('setting/user', 'AdminController@user')->name('user');
	});

	Route::get('supplier', 'SupplierController@index');
	Route::group(['as' => 'supplier::'], function() {
		Route::get('supplier', 'SupplierController@index')->name('supplier');
		Route::get('supplier/tambahsupplier', 'SupplierController@tambahsupplier')->name('tambahsupplier');
		Route::post('supplier/savesupplier', 'SupplierController@savesupplier')->name('savesupplier');
		Route::post('supplier/updatesupplier', 'SupplierController@updatesupplier')->name('updatesupplier');
		Route::get('supplier/tambahproduk/{id}', 'SupplierController@tambahproduk')->name('tambahproduk');
		Route::post('supplier/saveproduk/{id}', 'SupplierController@saveproduk')->name('saveproduk');
		Route::get('supplier/autocompleteproduk/{id}', 'SupplierController@autocompleteproduk')->name('autocplproduk');
	});
});

/*
 * Route for manager
 */
Route::group(['middleware' => ['auth', 'role:manager']], function() {
	//
});

/*
 * Route for apoteker
 */
Route::group(['middleware' => ['auth', 'role:apoteker']], function() {
	Route::group(['as' => 'obat::'], function() {
		Route::get('obat', 'ObatController@index')->name('obat');
		Route::get('obat/kategori', 'ObatController@kategori')->name('kategori');
		Route::post('obat/kategori', 'ObatController@kategori')->name('kategori');
		Route::delete('obat/kategori/{kategori}', 'ObatController@hapuskategori')->name('hapuskategori');
		Route::post('obat/updatekategori', 'ObatController@updatekategori')->name('updatekategori');
		Route::get('obat/tambahobat', 'ObatController@viewobat')->name('tambahobat');
		Route::post('obat/saveobat', 'ObatController@saveobat')->name('saveobat');
		Route::post('obat/updateobat', 'ObatController@updateobat')->name('updateobat');
	});

	Route::group(['prefix' => 'transaksi'], function() {
		Route::get('pemesananpembelian/{startdate?}/{enddate?}', 'TransaksiController@pemesananpembelian')->name('transaksi.pemesananpembelian');
		Route::get('tambahpemesananpembelian', 'TransaksiController@tambahpemesananpembelian')->name('transaksi.tambahpemesananpembelian');
		Route::post('simpanpemesananpembelian', 'TransaksiController@simpanpemesananpembelian')->name('transaksi.simpanpemesananpembelian');
		Route::get('detailpemesananpembelian/{id}', 'TransaksiController@detailpemesananpembelian')->name('transaksi.detailpemesananpembelian');
		Route::get('pembayaranpembelian', 'TransaksiController@pembayaranpembelian')->name('transaksi.pembayaranpembelian');
		Route::get('pembayaranpembelian/{kdpembelian?}', 'TransaksiController@pembayaranpembelian')->name('transaksi.pembayaranpembelian');
		Route::post('pembayaran/{kdpembelian}', 'TransaksiController@prosespembayaran')->name('transaksi.pembayaran');
		Route::get('autosupplier', 'TransaksiController@autosupplier')->name('transaksi.autosupplier');
		Route::get('autocompletebarangsupplier', 'TransaksiController@autocompletebarangsupplier')->name('transaksi.autocplbarangsupplier');

		Route::get('penjualan', 'TransaksiController@penjualan')->name('transaksi.penjualan');
	});
});

/*
 * Route for kasir
 */
Route::group(['middleware' => ['auth', 'role:kasir']], function() {
	Route::group(['prefix' => 'transaksi'], function() {
		Route::get('/', 'TransaksiController@penjualan');
		Route::get('penjualan', 'TransaksiController@penjualan')->name('transaksi.penjualan');
	});
});
Route::group(['middleware' => 'cors'], function () {
	Route::group(['prefix' => 'android'], function () {
		Route::get('supplier', 'SupplierController@androidsupplier')->name('android.supplier');
		Route::post('login', 'HomeController@androidlogin')->name('android.login');
	});
});