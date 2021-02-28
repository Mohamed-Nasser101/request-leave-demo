<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;

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

Route::get('/', function () { return redirect('/login');})->name('dashboard');

Route::get('/employee',[EmployeeController::class,'show'])->middleware('auth')->name('user');

Route::get('/manager',[ManagerPageController::class,'show'])->middleware('can:manager')->name('manager');

Route::resource('user.leave', LeaveController::class)->middleware('auth')->only('store','create');

Route::get('show/leave',[LeaveController::class,'index'])->middleware('can:manager')->name('show.leaves');

Route::patch('show/leave/{leave}',[LeaveController::class,'update'])->middleware('can:manager')->name('update.leaves');

require __DIR__.'/auth.php';
