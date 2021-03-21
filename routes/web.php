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

Route::get('/', function () {
    return view('welcome');
});

Route::get('adminLogin', function(){
    return view('admin.admin');
});
// Route::post('/products', 'ProductController::store')->name('addProducts');
Route::post('adminLogin', 'App\Http\Controllers\AdminController@adminLogin')->name('admin.adminLogin');

Route::resource('admin', App\Http\Controllers\AdminController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
