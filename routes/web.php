<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome', ['menuItems' => MenuItem::all()]);
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

// shows related dashboard based on role
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    }

    if (Auth::user()->role === 'staff') {
        return view('staff.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [RegisteredUserController::class, 'adminStore'])->name('users.adminStore');
});

// used route modal binding
Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [MenuItemController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuItemController::class, 'create'])->name('menu.create');
    Route::post('/menu/create', [MenuItemController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{item}', [MenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{item}', [MenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{item}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});

require __DIR__ . '/auth.php';
