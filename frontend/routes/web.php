<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', [App\Http\Controllers\client\HomeController::class, 'index'])->name('client.home');
Route::post('/search', [App\Http\Controllers\client\HomeController::class, 'search'])->name('client.search');

Route::get('/product/{slug}', [App\Http\Controllers\client\productController::class, 'showProductDetails'])->name('client.showProductDetails');
Route::get('/category/{slug}', [App\Http\Controllers\client\categoryController::class, 'catagoryWiseProduct'])->name('client.category');

// Cart
Route::get('/cart', [App\Http\Controllers\client\cartController::class, 'showCart'])->name('client.showCart');
Route::post('/cart', [App\Http\Controllers\client\cartController::class, 'addToCart'])->name('client.addCart');
Route::post('/cartRemove', [App\Http\Controllers\client\cartController::class, 'RemoveFromCart'])->name('client.cartRemove');
Route::get('/cartClear', [App\Http\Controllers\client\cartController::class, 'clearCart'])->name('client.ClearCart');
Route::get('/checkout', [App\Http\Controllers\client\cartController::class, 'checkout'])->name('client.checkout');

//shop page
Route::get('/shop', [App\Http\Controllers\client\shopController::class, 'shopIndex'])->name('client.shop');
Route::post('/getsingleProductdata', [App\Http\Controllers\client\shopController::class, 'getsingleProductdata'])->name('client.getsingleProductdata');

//Contact Page
Route::get('/contact', [App\Http\Controllers\client\contactController::class, 'contactIndex'])->name('client.contact');
Route::post('/contactSend', [App\Http\Controllers\client\contactController::class, 'contactSend'])->name('client.contactSend');

//About Page
Route::get('/about', [App\Http\Controllers\client\aboutPageController::class, 'aboutIndex'])->name('client.about');

//Login
Route::get('/login', [App\Http\Controllers\client\authController::class, 'showLogin'])->name('client.login');
Route::post('/onlogin', [App\Http\Controllers\client\authController::class, 'onlogin'])->name('client.onlogin');
Route::get('/registration', [App\Http\Controllers\client\authController::class, 'registration'])->name('client.registration');
Route::post('/addUser', [App\Http\Controllers\client\authController::class, 'addUser'])->name('client.addUser');
Route::get('/active/{token}', [App\Http\Controllers\client\authController::class, 'userActive'])->name('client.active');

//reset password
Route::get('/forgot', [App\Http\Controllers\client\authController::class, 'forgot'])->name('client.forgot');
Route::post('/forgotPassword', [App\Http\Controllers\client\authController::class, 'forgotPassword'])->name('client.forgotPassword');
Route::get('/recoverPassWord/{id}', [App\Http\Controllers\client\authController::class, 'recoverPassWord'])->name('client.recoverPassWord');
Route::post('/updatePassword', [App\Http\Controllers\client\authController::class, 'updatePassword'])->name('client.updatePassword');

//Rating
Route::post('/getproductreating', [\App\Http\Controllers\client\ReatingReviewController::class, 'getallreview'])->name('getproductreating');

// logout & Profile & Order
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [App\Http\Controllers\client\authController::class, 'logout'])->name('client.logout');
    Route::get('/profile', [App\Http\Controllers\client\authController::class, 'profile'])->name('client.profile');
    Route::get('/profileEdit/{id}', [App\Http\Controllers\client\authController::class, 'profileEdit'])->name('client.profileEdit');
    Route::post('/upadeteProfile/{id}', [App\Http\Controllers\client\authController::class, 'upadeteProfile'])->name('client.upadeteProfile');
    Route::post('/processOrder', [App\Http\Controllers\client\cartController::class, 'order'])->name('client.processOrder');
    Route::get('/orderDetails/{id}', [App\Http\Controllers\client\cartController::class, 'orderDetails'])->name('client.orderDetails');
    //Rating
    Route::post('/reating', [\App\Http\Controllers\client\ReatingReviewController::class, 'store'])->name('clint.reatingReview');

});





//Clear View cache:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>optimize cleared</h1>';
});


//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});



//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear Config cache:
Route::get('/Storage-link', function() {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Storage Link Created</h1>';
});


