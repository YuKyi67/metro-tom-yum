<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome', ['menuItems' => MenuItem::all()]);
});

Route::get('/about', fn() => view('about'));
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');

Route::get('/app', function () {
    $user = Auth::user();

    if (in_array($user->role, ['admin', 'staff'])) {
        $sales = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
            ->where('status', 'Completed')
            ->groupByRaw('DATE(created_at)')
            ->orderByDesc('date')
            ->get();

        $topItems = DB::table('orders')
            ->where('status', 'Completed')
            ->get()
            ->flatMap(fn($order) => collect(json_decode($order->items, true)))
            ->groupBy('name')
            ->map(fn($items) => $items->sum('quantity'))
            ->sortDesc()
            ->take(5);
    }

    return match ($user->role) {
        'admin' => view('admin.dashboard', compact('sales', 'topItems')),
        'staff' => view('staff.dashboard', compact('sales', 'topItems')),
        default => view('welcome', ['menuItems' => MenuItem::all()])
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Users
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [RegisteredUserController::class, 'store'])->name('users.store');
});

// Menu Management
Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [MenuItemController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuItemController::class, 'create'])->name('menu.create');
    Route::post('/menu/create', [MenuItemController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{item}', [MenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/edit/{item}', [MenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/menu/delete/{item}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});

// Feedback
Route::middleware(['auth'])->group(function () {
    Route::get('/feedback', [ContactUsController::class, 'feedback'])->name('contact-us.feedback');
});

// Cart & Orders
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add'); // ✅ changed to POST
    Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/order-history', [CartController::class, 'orderHistory'])->name('orders.history');
});

// Staff/Admin Orders
Route::middleware('auth')->group(function () {
    Route::get('/all-orders', [OrderController::class, 'viewAllOrders'])->name('orders.all');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Payment
Route::get('/payment/success', fn() => view('payment-success'))->name('payment.success');

require __DIR__ . '/auth.php';
