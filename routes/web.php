<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShortUrlController;
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


// Login

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Optional: redirect root to login
Route::get('/', function () {
    return redirect()->route('login.page');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    Route::get('/super-admin/dashboard', [AuthController::class, 'superAdminView'])->name('super.admin.dashboard');
    Route::get('/admin/dashboard', [AuthController::class, 'adminView'])->name('admin.dashboard');
    Route::get('/member/dashboard', [AuthController::class, 'memberView'])->name('member.dashboard');

    Route::post('/short-url/create', [ShortUrlController::class, 'create'])->name('short.create'); // <-- name added
    Route::get('/short-url/list', [ShortUrlController::class, 'list'])->name('short.list');
    Route::get('/short-url/{code}', [ShortUrlController::class, 'resolve'])->name('short.resolve');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
