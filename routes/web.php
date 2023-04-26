<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;

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
    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Tag
    Route::get('/admin/tag/{id}', [TagController::class, 'edit']);
    Route::delete('/tags/{tag}', [TagController::class, 'destroy']);
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/tag/{slug}', [TagController::class, 'getTagQuestions']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::put('/tags/{tag}', [TagController::class, 'update']);
    Route::get('/admin/tags', [TagController::class, 'allTags']);

    // User
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/admin/users/{id}', [UserController::class, 'edit']);

    // log
    Route::get('/logs', [LogController::class, 'index']);
    Route::get('/admin/logs/{id}', [LogController::class, 'edit']);

    // Search
    Route::get('/search', [SearchController::class, 'search']);

    // Role
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/admin/roles/{id}', [RoleController::class, 'edit']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
});
// Question
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/askQuestion', [QuestionController::class, 'create']);
Route::post('/askQuestion', [QuestionController::class, 'store']);
Route::get('/question/{slug}', [QuestionController::class, 'show']);
Route::delete('/question/{id}', [QuestionController::class, 'destroy']);
Route::get('/question/{id}/edit', [QuestionController::class, 'edit']);
// Route::put('/question/{id}', [QuestionController::class, 'update']);

// Answer
Route::post('/answer', [AnswerController::class, 'store']);
Route::delete('/answer/{id}', [AnswerController::class, 'destroy']);

// like
Route::post('/vote', [VoteController::class, 'vote']);


require __DIR__ . '/auth.php';
