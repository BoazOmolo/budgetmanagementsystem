<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\SourcesController;


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

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard');
    Route::get('/tables', [DatatableController::class, 'index'])->name('tables.index');
    Route::get('/incomes', [IncomesController::class, 'index'])->name('incomes.index');
    Route::get('/incomes/create', [IncomesController::class, 'create'])->name('incomes.create');
    Route::post('/incomes', [IncomesController::class, 'store'])->name('incomes.store');
    Route::get('/sources', [SourcesController::class, 'index'])->name('sources.index');
    Route::get('/sources/create', [SourcesController::class, 'create'])->name('sources.create');
    Route::post('/sources', [SourcesController::class, 'store'])->name('sources.store');
});

