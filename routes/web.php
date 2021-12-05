<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ComputerTypesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\WorkerController;
use App\Models\Computer;
use Illuminate\Support\Facades\Route;
use Nette\Schema\Context;

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


// COMPUTERS TYPES
Route::get('/computers/types', [ComputerTypesController::class, 'list'])->name('computer.type.list');

Route::get('/computers/types/{computerTypeId}/edit', [ComputerTypesController::class, 'edit'])->name('computer.type.edit');
Route::post('/computers/types/update', [ComputerTypesController::class, 'update'])->name('computer.type.update');

Route::get('/computers/types/create', [ComputerTypesController::class, 'create'])->name('computer.type.create');
Route::post('/comptuers/types/store', [ComputerTypesController::class, 'store'])->name('computer.type.store');

Route::get('/computers/types/{computerTypeId}/delete', [ComputerTypesController::class, 'delete'])->name('computer.type.delete');


// COMPUTERS
Route::get('/computers', [ComputerController::class, 'list'])->name('computer.list');
Route::get('/computers/{computerId}/show', [ComputerController::class, 'show'])->name('computer.show');

Route::get('/computers/create', [ComputerController::class, 'create'])->name('computer.create');
Route::post('computers/store', [ComputerController::class, 'store'])->name('computer.store');

Route::get('/computers/{computerId}/edit', [ComputerController::class, 'edit'])->name('computer.edit');
Route::post('/computers/update', [ComputerController::class, 'update'])->name('computer.update');


// PERIPHERALS
Route::get('/peripherals', [PeripheralController::class, 'list'])->name('peripheral.list');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
