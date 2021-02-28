<?php

use App\Http\Controllers\EmployeeController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/employee',[EmployeeController::class,'show'])->middleware('auth')->name('user');

Route::get('/manager', function () {
    return view('dashboard');
})->middleware('auth')->name('manager');

Route::resource('user.leave', LeaveController::class)
    ->middleware('auth');

require __DIR__.'/auth.php';
