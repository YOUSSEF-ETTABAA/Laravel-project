<?php

use App\Models\Contact;
use App\Models\CartItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheeckoutController;

use App\Http\Controllers\admin\DashbordController;
use App\Http\Controllers\Admin\ContactMailController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Models\Order;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route ::get('/',function(){
    return view('user.index');
})->name('index');

Route::get('/about',function(){
    return view('user.About');
})->name('about');

Route::get('/services',function(){
    return view('user.Services');
})->name('services');

Route::get('/blog',function(){
    return view('user.Blog');
})->name('blog');

Route::fallback(function(){
    return view('404');
});
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store');

Route::get('/shop', [ShopController::class,'index'])->name('shop');

Route::get('/login',[ProfileController::class,'index'])->name('login');
Route::post('/login',[ProfileController::class,'login'])->name('login.sumbit');


Route ::get('/thankyou',function(){
    return view('user.thankyou');
})->name('thankyou');

Route ::get('/register',[UserController::class,'showSignUpForm'])->name('signUp');
Route ::post('/register',[UserController::class,'store'])->name('signUp.sumbit');

Route::get('/cart',[CartController::class,'index'])
->name('cart'); 


Route::middleware('auth')->group(function (){

    Route::get('profile',[ProfileController::class,'ShowProfile'])
    ->name('user.profile');

    Route ::get('/logout',[ProfileController::class,'logout'])
    ->name('logout');

    Route::get('/profile/update', [ProfileController::class, 'ShowUpdateForm'])
    ->name('profile.update');

    Route::put('/profile/update', [ProfileController::class, 'updateUserProfile'])
    ->name('profile.update'); 

    Route::post('/update-picture',[ProfileController::class,'updatePicture'])
    ->name('profile.update.picture');
    
    Route::post('/cart/add', [CartController::class, 'addToCart']
    )->name('cart.add');

    Route::get('/cart/remove/{id}', [CartController::class, 'destroy'])
    ->name('cart.remove');

    Route::post('/cart/update',[CartController::class,'updateCart'])
    ->name('cart.update');

    Route::get('/cheeckout',[CheeckoutController::class,'index'])
    ->name('cheeckout.index');

    Route::post('/cheeckout/place-order',[CheeckoutController::class,'store'])
    ->name('cheeckout.store');

});


Route::group(['middleware' => ['auth', 'admin']], function () {
    
    Route::get('/admin/dashboard', DashbordController::class)
    ->name('admin.dashboard');

    Route::get('/admin/dashboard/contacts', [App\Http\Controllers\admin\ContactController::class, 'index'])
    ->name('contacts.index');

    Route::match(['get'],'/admin/dashboard/contact/respond/{id}',[App\Http\Controllers\admin\ContactController::class,'show'])
    ->name('admin.respond');

    Route::match(['post'],'/admin/dashboard/contact/respond/{id}',[ContactMailController::class,'index'])
    ->name('send-mail');
    
    Route::get('/admin/dashboard/contact/delete/{contact}',[App\Http\Controllers\admin\ContactController::class,'destroy'])
    ->name('admin.remove.contact');
    
    Route::get('/admin/dashboard/products',[ProductController::class,'index'])
    ->name('products.index');

    Route::post('/admin/dashboard/add-product',[ProductController::class,'store'])
    ->name('admin-create');

    Route::get('/admin/dashboard/update-product/{id}',[ProductController::class,'edit'])
    ->name('update.product.form');
    
    Route::post('/admin/dashboard/update-product/{id}',[ProductController::class,'update'])
    ->name('update.product.sumbit');

    Route::get('/admin/dashboard/remove-product/{product}',[ProductController::class,'destroy'])
    ->name('admin.remove.product');

    Route::get('/admin/dashboard/orders',[OrderController::class,'index'])
    ->name('orders.index');

    Route::get('/admin/dashboard/changeOrderStatus/{id}', [OrderController::class, 'changeOrderStatus'])
    ->name('changeOrderStatus');

    Route::get('/admin/dashboard/changePayStatus/{id}', [OrderController::class, 'changePayStatus'])
    ->name('changePayStatus');

    Route::get('/admin/dashboard/order-details/{id}',[OrderController::class,'OrderDetails'])
    ->name('order.details');

    Route::get('/admin/dashboard/search-orders',[OrderController::class,'search'])
    ->name('searchOrders');

    Route::get('/admin/dashboard/active-orders',[OrderController::class,'activeOrders'])
    ->name('orders.active.index');

    Route::post('/admin/dashboard/orders/active/{id}',[OrderController::class,'activeOrder'])
    ->name('active-order');

    Route::get('/orders/{id}', [OrderController::class, 'getOrderDetails'])
    ->name('orders.details');
});