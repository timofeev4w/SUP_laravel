<?php

use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Models\User;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\UsersController;

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

Route::view('/', 'index')->name('home');

Route::get('/clients/create', [ClientsController::class, 'create']);
Route::post('/clients', [ClientsController::class, 'store']);

Route::get('/admin/login', [AdminsController::class, 'login'])->name('admin_login');
Route::post('/admin/login', [AdminsController::class, 'loginPost']);

Route::middleware('auth:admin')->prefix('/admin')->group(function() {
    Route::get('', [AdminsController::class, 'index'])->name('admin');
    Route::get('/manager_registration', [AdminsController::class, 'managerCreate'])->name('manager_registration');
    Route::post('/manager_registration', [AdminsController::class, 'managerStore']);
    Route::get('/logout', [AdminsController::class, 'logout'])->name('admin_logout');
});

Route::middleware('auth:manager')->prefix('/manager')->group(function(){
    Route::get('', [ManagersController::class, 'index'])->name('manager');
    Route::get('/report', [ManagersController::class, 'getReport'])->name('report');
    Route::get('/client/{id}', [ManagersController::class, 'getClient']);
    Route::get('/client/{id}/edit', [ManagersController::class, 'edit']);
    Route::put('/client/{id}', [ManagersController::class, 'update']);
    Route::delete('/client/{id}', [ManagersController::class, 'destroy']);
    Route::get('/logout', [ManagersController::class, 'logout'])->name('logout');
});
Route::prefix('/manager')->group(function(){
    Route::get('/login', [ManagersController::class, 'login'])->name('login');
    Route::post('/login', [ManagersController::class, 'loginPost']);
});
