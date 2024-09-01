<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Models\Product;
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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::get('/admin', [ProductController::class, 'admin'])->name('admin.dashboard');
    Route::get('/staff', [ProductController::class, 'staff'])->name('staff.dashboard');
    Route::get('/customer', [ProductController::class, 'customer'])->name('customer.dashboard');
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin', [ProductController::class, 'admin'])->name('admin.dashboard');
        Route::get('/admin/create-staff', [AdminController::class, 'createStaff'])->name('admin.create-staff');
        Route::post('/admin/create-staff', [AdminController::class, 'storeStaff'])->name('admin.store-staff');
        Route::get('/admin/staff', [AdminController::class, 'showStaff'])->name('admin.index');
        Route::delete('/admin/staff/{id}', [AdminController::class, 'deleteStaff'])->name('admin.delete-staff');
        Route::get('/admin/staff/{id}/edit', [AdminController::class, 'editStaff'])->name('admin.edit-staff');
        Route::put('/admin/staff/{id}', [AdminController::class, 'updateStaff'])->name('admin.update-staff');


    });
    
    Route::middleware(['auth', 'role:staff'])->group(function () {
        Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
        Route::get('/staff', [ProductController::class, 'staff'])->name('staff.dashboard');
    });
    
    Route::middleware(['auth', 'role:customer'])->group(function () {
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
        Route::get('/customer', [ProductController::class, 'customer'])->name('customer.dashboard');
    });
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/customer/search', [CustomerController::class, 'searchs'])->name('customer.search');
    Route::get('/products/{id}', [ProductController::class, 'shows'])->name('products.show');

    Route::get('/customer/dashboard', [CustomerController::class, 'dashboards'])->name('customer.dashboard');
    Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');





    
    Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    

    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

    });

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    


    Route::middleware(['auth'])->group(function () {
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');

    Route::get('addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('addresses', [AddressController::class, 'store'])->name('addresses.store');
        
    });

    Route::post('/buy-now/{id}', [CustomerController::class, 'buyNow'])->name('buyNow');

    Route::get('/products', [CustomerController::class, 'showProducts'])->name('products');
    Route::post('/buy-now/{id}', [CustomerController::class, 'buyNow'])->name('buyNow');

    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/checkout/{product}', [CheckoutController::class, 'immediateCheckout'])->name('checkout.immediate');



    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/order/{product}', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/{order}', [OrderController::class, 'showOrder'])->name('order.show');

    Route::get('/product/customize/{id}', [CustomizationController::class, 'creates'])->name('customization.customize');
    Route::post('/product/customize/{id}', [CustomizationController::class, 'store'])->name('product.customize.store');
    Route::get('/customize/{id}', [CustomizationController::class, 'creates'])->name('customization.customize');
    Route::post('/customize/{id}', [CustomizationController::class, 'store'])->name('customization.store');
    
    Route::post('/cart/save-customization', [CartController::class, 'saveCustomization'])->name('cart.save.customization');


});

require __DIR__.'/auth.php';
