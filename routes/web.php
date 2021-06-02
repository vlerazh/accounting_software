<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyDetailsController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::resource('categories', CategoryController::class);
	Route::resource('customers', CustomerController::class);
	Route::resource('items', ItemController::class);
	Route::resource('invoices', InvoiceController::class);

	Route::get('invoice/export', [InvoiceController::class , 'export'])->name('exportInvoice');
	Route::get('item/export', [ItemController::class ,'export'])->name('exportItem');
	Route::get('customers/export', [CustomerController::class ,'export'])->name('exportCustomer');


});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::prefix('data')->namespace('Data')->group(function () {
	Route::get('/all' , [CustomerController::class, 'all']);
	Route::get('/show/{customer}' , [CustomerController::class, 'show']);
	Route::get('/company/details' , [CompanyDetailsController::class , 'details']);
});