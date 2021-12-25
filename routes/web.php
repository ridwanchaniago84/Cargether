<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PricesController; 
use App\Http\Controllers\VechiclesController;
use App\Http\Controllers\CompenCategoriesController;
use App\Http\Controllers\CompensationsController;
use App\Http\Controllers\SpendingsController;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/barchart', [DashboardController::class, 'getDataTrasaction'])->name('barchart');
    
    Route::resource('users', UserController::class)->parameters(['users' => 'id'])->except(['show']);
    Route::resource('members', MemberController::class)->parameters(['members' => 'id'])->except(['show']);
    Route::resource('transaction', TransactionController::class)->parameters(['transaction' => 'id'])->except(['show']);
    Route::resource('prices', PricesController::class)->parameters(['price' => 'id'])->except(['show']);
    Route::resource('vechicles', VechiclesController::class)->parameters(['vechicle' => 'id'])->except(['show']);
    Route::resource('compencategories', CompenCategoriesController::class)->parameters(['compenCategories' => 'id'])->except(['show']);
    Route::resource('compensations', CompensationsController::class)->parameters(['compensations' => 'id'])->except(['show']);
    Route::resource('spendings', SpendingsController::class)->parameters(['spendings' => 'id'])->except(['show']);

    Route::get('spendings/print', [SpendingsController::class, 'print'])->name('print');
});