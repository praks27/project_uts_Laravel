<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;


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
Route::get('/transaction', [TransactionController::class, 'store']);


Auth::routes(['verify' => true]);

Route::group(['middleware'=>['auth','verified']] , function(){
    Route::resource('/product', ProductController::class);
    Route::resource('/category', CategoryController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/example', [App\Http\Controllers\ExampleController::class, 'example'])->name('dashboard');
});
