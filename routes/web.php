<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ComputerTypesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\PeripheralTypeController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\WorkerController;
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

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');


// WORKERS
Route::get('/workers/ajax-request-get', [WorkerController::class, 'ajaxList']);

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

Route::get('/computers/{computerId}/delete', [ComputerController::class, 'delete'])->name('computer.delete');


// SOFTWARES
Route::get('/softwares', [SoftwareController::class, 'list'])->name('software.list');
Route::get('/softwares/{softwareId}/show', [SoftwareController::class, 'show'])->name('software.show');

Route::get('/softwares/create', [SoftwareController::class, 'create'])->name('software.create');
Route::post('/softwares/store', [SoftwareController::class, 'store'])->name('software.store');

Route::get('/softwares/{softwareId}/edit', [SoftwareController::class, 'edit'])->name('software.edit');
Route::post('/softwares/update', [SoftwareController::class, 'update'])->name('software.update');

Route::get('/softwares/{softwareId}/delete', [SoftwareController::class, 'delete'])->name('software.delete');



// PERIPHERALS
Route::get('/peripherals', [PeripheralController::class, 'list'])->name('peripheral.list');
Route::get('/peripherals/{peripheralId}/show', [PeripheralController::class, 'show'])->name('peripheral.show');

Route::get('/peripheral/create', [PeripheralController::class, 'create'])->name('peripheral.create');
Route::post('/peripherals/store', [PeripheralController::class, 'store'])->name('peripheral.store');

Route::get('/peripherals/{peripheralId}/edit', [PeripheralController::class, 'edit'])->name('peripheral.edit');
Route::post('/peripherals/update', [PeripheralController::class, 'update'])->name('peripheral.update');

Route::get('/peripherals/{peripheralId}/delete', [PeripheralController::class, 'delete'])->name('peripheral.delete');


// PERIPHERALS TYPES
Route::get('/peripherals/types', [PeripheralTypeController::class, 'list'])->name('peripheral.type.list');

Route::get('/peripherals/types/{peripheralTypeId}/edit', [PeripheralTypeController::class, 'edit'])->name('peripheral.type.edit');
Route::get('/peripherals/types/update', [PeripheralTypeController::class, 'update'])->name('peripheral.type.update');

Route::get('/peripherals/types/create', [PeripheralTypeController::class, 'create'])->name('peripheral.type.create');
Route::post('/peripherals/types/store', [PeripheralTypeController::class, 'store'])->name('peripheral.type.store');

Route::get('/peripherals/types/{peripheralTypeId}/delete', [PeripheralTypeController::class, 'delete'])->name('peripheral.type.delete');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
