<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\SourcesController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\ExpensesCategoriesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FilesController;


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
    Route::get('/budgets', [BudgetsController::class, 'index'])->name('budgets.index');
    Route::get('/budgets/create', [BudgetsController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetsController::class, 'store'])->name('budgets.store');
    Route::get('/expensescategories', [ExpensesCategoriesController::class, 'index'])->name('expensescategories.index');
    Route::get('/expensescategories/create', [ExpensesCategoriesController::class, 'create'])->name('expensescategories.create');
    Route::post('/expensescategories', [ExpensesCategoriesController::class, 'store'])->name('expensescategories.store');
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/files', [FilesController::class, 'index'])->name('files.index');
    Route::get('/files/create', [FilesController::class, 'create'])->name('files.create');
    Route::post('/files', [FilesController::class, 'store'])->name('files.store');
});

