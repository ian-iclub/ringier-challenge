<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
# ----------------------------------------------------------------------------------------------------------------------
# GUEST ROUTES
# ----------------------------------------------------------------------------------------------------------------------

# Index page
Route::get('/', [RouteController::class, 'index'])->name('index');

# List products
//Route::resource('products', ProductController::class)->only([
//    'index', 'show'
//]);

Route::resource('products', ProductController::class);

# ----------------------------------------------------------------------------------------------------------------------
# PROTECTED ROUTES
# ----------------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'auth'], function (){

    # My dashboard
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('dashboard');

//    # Manage products
//    Route::resource('products', ProductController::class)->except([
//        'index', 'show'
//    ]);

});
