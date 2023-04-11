<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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
    return view('landing-page');
});
// Route::get('/a', function () {
//     return view('landing-page');
// });
Route::get('/settings', function () {
    return view('settings');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/tags', [TagController::class, 'index']);
// delete tag
Route::delete('/tags/{tag}', [TagController::class, 'destroy']);
Route::put('/users/{id}', [UserController::class, 'update']);
// delete user
Route::delete('/users/{id}', [UserController::class, 'destroy']);


Route::get('/admin/users/{id}', [UserController::class, 'edit']);
Route::get('/admin/tag/{id}', [TagController::class, 'edit']);
Route::get('/me', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
