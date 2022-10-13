<?php

use App\Http\Controllers\Api\Foreign\CurrencyController;
use App\Http\Controllers\Api\Foreign\DeeplController;
use App\Http\Controllers\Api\Foreign\ViesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ComputerTypesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\PeripheralTypeController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::group([
    'middleware' => ['auth']
], function () {
    // WORKERS
    Route::group([
        'prefix' => 'workers',
        'as' => 'worker.'
    ], function () {
        Route::get('/workers/ajax-request-get', [WorkerController::class, 'ajaxList']);

        Route::get('/', [WorkerController::class, 'list'])->name('list');
        Route::get('/searchworker',[WorkerController::class, 'searchWorker'])->name('searchWorker');

        Route::get('/{workerId}/show', [WorkerController::class, 'show'])->name('show');

        Route::get('/create', [WorkerController::class, 'create'])->name('create');
        Route::post('/store', [WorkerController::class, 'store'])->name('store');

        Route::get('/{workerId}/edit', [WorkerController::class, 'edit'])->name('edit');
        Route::post('/update', [WorkerController::class, 'update'])->name('update');

        Route::get('/{workerId}/delete', [WorkerController::class, 'delete'])->name('delete');
    });

    // DEPARTMENTS
    Route::group([
        'prefix' => 'departments',
        'as' => 'department.'
    ], function () {
        Route::get('/', [DepartmentController::class, 'list'])->name('list');
        Route::get('/searchdepartment',[DepartmentController::class, 'searchDepartment'])->name('searchDepartment');

        Route::post('/store', [DepartmentController::class, 'store'])->name('store');

        Route::get('/{departmentId}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/update', [DepartmentController::class, 'update'])->name('update');

        Route::get('/{departmentId}/delete', [DepartmentController::class, 'delete'])->name('delete');
    });

    // COMPUTERS TYPES
    Route::group([
        'prefix' => 'computers/types',
        'as' => 'computer.type.'
    ], function () {
        Route::get('/', [ComputerTypesController::class, 'list'])->name('list');
        Route::get('/searchcomputertype', [ComputerTypesController::class, 'searchComputerType'])->name('searchComputerType');

        Route::get('/{computerTypeId}/edit', [ComputerTypesController::class, 'edit'])->name('edit');
        Route::post('/update', [ComputerTypesController::class, 'update'])->name('update');

        Route::get('/create', [ComputerTypesController::class, 'create'])->name('create');
        Route::post('/store', [ComputerTypesController::class, 'store'])->name('store');

        Route::get('/{computerTypeId}/delete', [ComputerTypesController::class, 'delete'])->name('delete');
    });

    // COMPUTERS
    Route::group([
        'prefix' => 'computers',
        'as' => 'computer.'
    ], function () {
        Route::get('/', [ComputerController::class, 'list'])->name('list');
        Route::get('/searchcomputer', [ComputerController::class, 'searchComputer'])->name('searchComputer');

        Route::get('/{computerId}/show', [ComputerController::class, 'show'])->name('show');

        Route::get('/create', [ComputerController::class, 'create'])->name('create');
        Route::post('/store', [ComputerController::class, 'store'])->name('store');

        Route::get('/{computerId}/edit', [ComputerController::class, 'edit'])->name('edit');
        Route::post('/update', [ComputerController::class, 'update'])->name('update');

        Route::get('/{computerId}/delete', [ComputerController::class, 'delete'])->name('delete');
    });

    // SOFTWARES
    Route::group([
        'prefix' => 'softwares',
        'as' => 'software.'
    ], function () {
        Route::get('/', [SoftwareController::class, 'list'])->name('list');
        Route::get('/searchsoftware', [SoftwareController::class, 'searchSoftware'])->name('searchSoftware');

        Route::get('/{softwareId}/show', [SoftwareController::class, 'show'])->name('show');

        Route::get('/create', [SoftwareController::class, 'create'])->name('create');
        Route::post('/store', [SoftwareController::class, 'store'])->name('store');

        Route::get('/{softwareId}/edit', [SoftwareController::class, 'edit'])->name('edit');
        Route::post('/update', [SoftwareController::class, 'update'])->name('update');

        Route::get('/{softwareId}/delete', [SoftwareController::class, 'delete'])->name('delete');
    });

    // PERIPHERALS
    Route::group([
        'prefix' => 'peripherals',
        'as' => 'peripheral.'
    ], function () {
        Route::get('/', [PeripheralController::class, 'list'])->name('list');
        Route::get('/searchperipheral', [PeripheralController::class, 'searchPeripheral'])->name('searchPeripheral');

        Route::get('/{peripheralId}/show', [PeripheralController::class, 'show'])->name('show');

        Route::get('/create', [PeripheralController::class, 'create'])->name('create');
        Route::post('/store', [PeripheralController::class, 'store'])->name('store');

        Route::get('/{peripheralId}/edit', [PeripheralController::class, 'edit'])->name('edit');
        Route::post('/update', [PeripheralController::class, 'update'])->name('update');

        Route::get('/{peripheralId}/delete', [PeripheralController::class, 'delete'])->name('delete');
    });

    // PERIPHERALS TYPES
    Route::group([
        'prefix' => 'peripherals/types',
        'as' => 'peripheral.type.'
    ], function () {
        Route::get('/', [PeripheralTypeController::class, 'list'])->name('list');
        Route::get('/searchperipheraltype', [PeripheralTypeController::class, 'searchPeripheralType'])->name('searchPeripheralType');

        Route::get('/{peripheralTypeId}/edit', [PeripheralTypeController::class, 'edit'])->name('edit');
        Route::get('/update', [PeripheralTypeController::class, 'update'])->name('update');

        Route::get('/create', [PeripheralTypeController::class, 'create'])->name('create');
        Route::post('/store', [PeripheralTypeController::class, 'store'])->name('store');

        Route::get('/{peripheralTypeId}/delete', [PeripheralTypeController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'currency',
        'as' => 'currency.',
    ], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::get('/downloadcurrency', [CurrencyController::class, 'downloadData'])->name('downloadData');
    });

    Route::group([
        'prefix' => 'vies',
        'as' => 'vies.',
    ], function () {
        Route::get('/', [ViesController::class, 'index'])->name('index');
    });
});

Route::group([
    'prefix' => 'deepl',
    'as' => 'deepl.'
], function () {
    Route::get('/', [DeeplController::class, 'index'])->name('index');
    Route::post('/deepltranslation', [DeeplController::class, 'translate'])->name('translation');
});



Route::get('/calculator/tank', function () {
    return view('calculator.tank');
})->name('calculator.tank');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Technical rotues
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:cache');
    return 'Cache done';
});

Route::get('/database-migration', function() {
    $exitCode = Artisan::call('migrate:rollback');
    $exitCode = Artisan::call('migrate');
    return 'Migration done';
});

Route::get('/database-seed', function() {
    $exitCode = Artisan::call('db:seed');
    return 'Seeding done';
});

