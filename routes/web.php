<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\User\UserController;

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
// });

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('/');

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/menu/{name}', [OrderController::class, 'menuView'])->name('menu-view');
Route::get('/customer/order', [OrderController::class, 'index'])->name('customer-order');
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::post('/update-cart', [CartController::class, 'updateCart']);
Route::post('/delete-cart-item', [CartController::class, 'romoveCartItem']);
Route::get('/load-cart-data', [CartController::class, 'cartCount']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //menu
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus');
    Route::get('/admin/add/menu', [MenuController::class, 'create'])->name('admin.add-menu');
    Route::post('/admin/menu/add', [MenuController::class, 'storeMenu'])->name('admin.store-menu');
    Route::get('/admin/menu/edit/{id}', [MenuController::class, 'editMenu'])->name('admin.edit-menu');
    Route::put('/admin/menu/update/{id}', [MenuController::class, 'updateMenu'])->name('admin.update-menu');
    Route::delete('/admin/menu/delete/{id}', [MenuController::class, 'deleteMenu'])->name('admin.delete-menu');

    //table
    Route::get('/admin/tables', [TableController::class, 'index'])->name('admin.tables');
    Route::get('/admin/add/table', [TableController::class, 'create'])->name('admin.add-table');
    Route::post('/admin/table/add', [TableController::class, 'storeTable'])->name('admin.store-table');
    Route::delete('/admin/table/delete/{id}', [TableController::class, 'deleteTable'])->name('admin.delete-table');

    //admin order
    Route::get('/admin/orders', [OrderController::class, 'OrderIndex'])->name('admin.orders');
    Route::get('/admin/view-order/{id}', [OrderController::class, 'view'])->name('admin.view-order');
    Route::put('/admin/update-order/{id}', [OrderController::class, 'update'])->name('admin.update-order');
    Route::get('/admin/order-history', [OrderController::class, 'orderHistory'])->name('admin.order-history');

    
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');

    Route::get('/my-orders', [UserController::class, 'index'])->name('my-orders');
    Route::get('/view-order/{id}', [UserController::class, 'viewOrder'])->name('view-order');
    
    // Laravel 8 & 9
    Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
    // Laravel 8 & 9
    Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);

});


require __DIR__.'/auth.php';
