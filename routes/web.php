<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\WorkerController;
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
    return view('dashboard');
})->name('dashboard');


// WORKERS
Route::get('/workers', [WorkerController::class, 'list'])->name('worker.list');
Route::get('/workers/{workerId}/show', [WorkerController::class, 'show'])->name('worker.show');

Route::get('/workers/create', [WorkerController::class, 'create'])->name('worker.create');
Route::post('/workers/store', [WorkerController::class, 'store'])->name('worker.store');

Route::get('/workers/{workerId}/edit', [WorkerController::class, 'edit'])->name('worker.edit');
Route::post('/workers/update', [WorkerController::class, 'update'])->name('worker.update');

Route::get('/workers/{workerId}/delete', [WorkerController::class, 'delete'])->name('worker.delete');


// DEPARTMENTS
Route::get('/departments', [DepartmentController::class, 'list'])->name('department.list');

Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('department.store');

Route::get('departments/{departmentId}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::post('/departments/update', [DepartmentController::class, 'update'])->name('department.update');

Route::get('/departments/{departmentId}/delete', [DepartmentController::class, 'delete'])->name('department.delete');


// COMPUTERS
Route::get('/computers', [ComputerController::class, 'list'])->name('computer.list');
Route::get('/computers/{computerId}/show', [ComputerController::class, 'show'])->name('computer.show');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
