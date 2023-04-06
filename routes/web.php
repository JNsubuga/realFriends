<?php

use App\Http\Controllers\MembersController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/members')->group(function () {
    Route::get('/', [MembersController::class, 'index'])->name('member.index');
    Route::get('/create', [MembersController::class, 'create'])->name('member.create');
    Route::post('/', [MembersController::class, 'store'])->name('member.store');
    Route::get('/{id}', [MembersController::class, 'show'])->where('id', '[0-9]+')->name('member.show');
    Route::get('/member_accounts/{id}', [MembersController::class, 'memberAccounts'])->where('id', '[0-9]+')->name('member.memberAccounts');
    Route::get('/{id}/edit', [MembersController::class, 'edit'])->name('member.edit');
    Route::put('/{id}', [MembersController::class, 'update'])->name('member.update');
    Route::delete('/{id}', [MembersController::class, 'destroy'])->name('member.destroy');
});
