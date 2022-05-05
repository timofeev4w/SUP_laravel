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

Route::middleware('auth:manager')->group(function(){
    Route::get('/manager', [ManagersController::class, 'index'])->name('manager');
    Route::get('/manager/report', [ManagersController::class, 'getReport'])->name('report');
});

Route::get('/manager/registration', [ManagersController::class, 'registration'])->name('registration');
Route::post('/manager/registration', [ManagersController::class, 'registrationStore']);

Route::get('/manager/login', [ManagersController::class, 'login'])->name('login');
Route::post('/manager/login', [ManagersController::class, 'loginPost']);

Route::get('/manager/logout', [ManagersController::class, 'logout'])->name('logout');

// Route::get('/manager/user', [UsersController::class, 'registration']);
// Route::post('/manager/user', [UsersController::class, 'registrationStore']);
