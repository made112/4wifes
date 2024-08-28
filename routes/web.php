<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

;
Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/export-users', [\App\Http\Controllers\Admin\UsersController::class, 'exportUsers'])->name('export-users');

    Route::get('/delete/user/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('user.delete');

});

require __DIR__.'/auth.php';
