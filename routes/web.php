<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\SourcesController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\ExpensesCategoriesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;


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
    Route::get('/incomes/{income}', [IncomesController::class, 'show'])->name('incomes.show');
    Route::get('/incomes/{income}/edit', [IncomesController::class, 'edit'])->name('incomes.edit');
    Route::put('/incomes/{income}', [IncomesController::class, 'update'])->name('incomes.update');
    Route::delete('/incomes/{id}', [IncomesController::class, 'destroy']) ->name('incomes.destroy');
    Route::get('/sources', [SourcesController::class, 'index'])->name('sources.index');
    Route::get('/sources/create', [SourcesController::class, 'create'])->name('sources.create');
    Route::post('/sources', [SourcesController::class, 'store'])->name('sources.store');
    Route::get('/sources/{source}', [SourcesController::class, 'show'])->name('sources.show');
    Route::get('/sources/{source}/edit', [SourcesController::class, 'edit'])->name('sources.edit');
    Route::put('/sources/{source}', [SourcesController::class, 'update'])->name('sources.update');
    Route::delete('/sources/{id}', [SourcesController::class, 'destroy']) ->name('sources.destroy');
    Route::get('/budgets', [BudgetsController::class, 'index'])->name('budgets.index');
    Route::get('/budgets/create', [BudgetsController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetsController::class, 'store'])->name('budgets.store');
    Route::get('/budgets/{budget}', [BudgetsController::class, 'show'])->name('budgets.show');
    Route::get('/budgets/{budget}/edit', [BudgetsController::class, 'edit'])->name('budgets.edit');
    Route::put('/budgets/{budget}', [BudgetsController::class, 'update'])->name('budgets.update');
    Route::delete('/budgets/{id}', [BudgetsController::class, 'destroy']) ->name('budgets.destroy');
    Route::get('/budgets/{year}/{month}',[BudgetsController::class, 'showbudgets'])->name('budgets.showbudgets');
    Route::get('/expenses/{year}/{month}',[ExpensesController::class, 'showexpenses'])->name('expenses.showexpenses');
    Route::get('/expensescategories', [ExpensesCategoriesController::class, 'index'])->name('expensescategories.index');
    Route::get('/expensescategories/create', [ExpensesCategoriesController::class, 'create'])->name('expensescategories.create');
    Route::post('/expensescategories', [ExpensesCategoriesController::class, 'store'])->name('expensescategories.store');
    Route::get('/expensescategories/{expensescategory}', [ExpensesCategoriesController::class, 'show'])->name('expensescategories.show');
    Route::get('/expensescategories/{expensescategory}/edit', [ExpensesCategoriesController::class, 'edit'])->name('expensescategories.edit');
    Route::put('/expensescategories/{expensescategory}', [ExpensesCategoriesController::class, 'update'])->name('expensescategories.update');
    Route::delete('/expensescategories/{id}', [ExpensesCategoriesController::class, 'destroy']) ->name('expensescategories.destroy');
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpensesController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{id}', [ExpensesController::class, 'destroy']) ->name('expenses.destroy');
    Route::get('/files', [FilesController::class, 'index'])->name('files.index');
    Route::get('/files/create', [FilesController::class, 'create'])->name('files.create');
    Route::post('/files', [FilesController::class, 'store'])->name('files.store');
    Route::get('/files/{file}', [FilesController::class, 'show'])->name('files.show');
    Route::delete('/files/{id}', [FilesController::class, 'destroy']) ->name('files.destroy');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/createuser', [AdminController::class, 'createUserView'])->name('admin.createuser.view');
    Route::post('/createuser', [AdminController::class, 'createuser'])->name('admin.createuser'); 
    Route::get('/createadmin', [AdminController::class, 'createAdminView'])->name('admin.createadmin.view');
    Route::post('/createadmin', [AdminController::class, 'createadmin'])->name('admin.createadmin'); 
    Route::get('/incomes', [IncomesController::class, 'index'])->name('incomes.index');
    Route::get('/incomes/create', [IncomesController::class, 'create'])->name('incomes.create');
    Route::post('/incomes', [IncomesController::class, 'store'])->name('incomes.store');
    Route::get('/incomes/{income}', [IncomesController::class, 'show'])->name('incomes.show');
    Route::get('/incomes/{income}/edit', [IncomesController::class, 'edit'])->name('incomes.edit');
    Route::put('/incomes/{income}', [IncomesController::class, 'update'])->name('incomes.update');
    Route::delete('/incomes/{id}', [IncomesController::class, 'destroy']) ->name('incomes.destroy');
    Route::get('/sources', [SourcesController::class, 'index'])->name('sources.index');
    Route::get('/sources/create', [SourcesController::class, 'create'])->name('sources.create');
    Route::post('/sources', [SourcesController::class, 'store'])->name('sources.store');
    Route::get('/sources/{source}', [SourcesController::class, 'show'])->name('sources.show');
    Route::get('/sources/{source}/edit', [SourcesController::class, 'edit'])->name('sources.edit');
    Route::put('/sources/{source}', [SourcesController::class, 'update'])->name('sources.update');
    Route::delete('/sources/{id}', [SourcesController::class, 'destroy']) ->name('sources.destroy');
    Route::get('/budgets', [BudgetsController::class, 'index'])->name('budgets.index');
    Route::get('/budgets/create', [BudgetsController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetsController::class, 'store'])->name('budgets.store');
    Route::get('/budgets/{budget}', [BudgetsController::class, 'show'])->name('budgets.show');
    Route::get('/budgets/{budget}/edit', [BudgetsController::class, 'edit'])->name('budgets.edit');
    Route::put('/budgets/{budget}', [BudgetsController::class, 'update'])->name('budgets.update');
    Route::delete('/budgets/{id}', [BudgetsController::class, 'destroy']) ->name('budgets.destroy');
    Route::get('/budgets/{year}/{month}',[BudgetsController::class, 'showbudgets'])->name('budgets.showbudgets');
    Route::get('/expenses/{year}/{month}',[ExpensesController::class, 'showexpenses'])->name('expenses.showexpenses');
    Route::get('/expensescategories', [ExpensesCategoriesController::class, 'index'])->name('expensescategories.index');
    Route::get('/expensescategories/create', [ExpensesCategoriesController::class, 'create'])->name('expensescategories.create');
    Route::post('/expensescategories', [ExpensesCategoriesController::class, 'store'])->name('expensescategories.store');
    Route::get('/expensescategories/{expensescategory}', [ExpensesCategoriesController::class, 'show'])->name('expensescategories.show');
    Route::get('/expensescategories/{expensescategory}/edit', [ExpensesCategoriesController::class, 'edit'])->name('expensescategories.edit');
    Route::put('/expensescategories/{expensescategory}', [ExpensesCategoriesController::class, 'update'])->name('expensescategories.update');
    Route::delete('/expensescategories/{id}', [ExpensesCategoriesController::class, 'destroy']) ->name('expensescategories.destroy');
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpensesController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{id}', [ExpensesController::class, 'destroy']) ->name('expenses.destroy');
    Route::get('/files', [FilesController::class, 'index'])->name('files.index');
    Route::get('/files/create', [FilesController::class, 'create'])->name('files.create');
    Route::post('/files', [FilesController::class, 'store'])->name('files.store');
    Route::get('/files/{file}', [FilesController::class, 'show'])->name('files.show');
    Route::delete('/files/{id}', [FilesController::class, 'destroy']) ->name('files.destroy');
    Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
});

