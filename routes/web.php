<?php

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

Route::view('/', 'index');

Route::resource('/clients', ClientsController::class);

Route::middleware('auth:manager')->prefix('/manager')->group(function(){
    Route::get('', [ManagersController::class, 'index'])->name('manager');
    Route::get('/report', [ManagersController::class, 'getReport'])->name('report');
    Route::get('/client/{id}', [ManagersController::class, 'getClient']);
    Route::get('/client/{id}/edit', [ManagersController::class, 'edit']);
    Route::put('/client/{id}', [ManagersController::class, 'update']);
    Route::delete('/client/{id}', [ManagersController::class, 'destroy']);
});
Route::prefix('/manager')->group(function(){
    Route::get('/registration', [ManagersController::class, 'registration'])->name('registration');
    Route::post('/registration', [ManagersController::class, 'registrationStore']);

    Route::get('/login', [ManagersController::class, 'login'])->name('login');
    Route::post('/login', [ManagersController::class, 'loginPost']);

    Route::get('/logout', [ManagersController::class, 'logout'])->name('logout');
});


// Route::get('/manager/user', [UsersController::class, 'registration']);
// Route::post('/manager/user', [UsersController::class, 'registrationStore']);
