<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});
Route::middleware(['auth'])->group(function (){
    Route::get('dashboard', [\App\Http\Controllers\PostController::class, 'index'])->name('dashboard');
    Route::get('add-post', [\App\Http\Controllers\PostController::class, 'create'])->name('add-post');
    Route::post('store-post', [\App\Http\Controllers\PostController::class, 'store'])->name('store-post');
    Route::get('edit-post/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->name('edit-post');
    Route::put('update-post/{id}', [\App\Http\Controllers\PostController::class, 'update'])->name('update-post');
    Route::delete('delete-post/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('delete-post');

    Route::resource('roles', \App\Http\Controllers\RoleController::class);

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
