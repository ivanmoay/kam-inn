<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\RoomPricingController;

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

Route::get('/', function () {
    if(Auth::check()){
        return view('index');
    }else{
        return view('auth.login');
    }
    
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/users',[UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('/items/create', [ItemController::class, 'create']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items/{item}/edit', [ItemController::class, 'edit']);
    Route::put('/items/{item}', [ItemController::class, 'update']);
    Route::delete('/items/{item}', [ItemController::class, 'destroy']);

    Route::get('/rooms/create', [RoomController::class, 'create']);
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit']);
    Route::put('/rooms/{room}', [RoomController::class, 'update']);
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

    Route::get('/room_pricings/create', [RoomPricingController::class, 'create']);
    Route::post('/room_pricings', [RoomPricingController::class, 'store']);
    Route::get('/room_pricings/{room_pricing}/edit', [RoomPricingController::class, 'edit']);
    Route::put('/room_pricings/{room_pricing}', [RoomPricingController::class, 'update']);
    Route::delete('/room_pricings/{room_pricing}', [RoomPricingController::class, 'destroy']);

    Route::get('/summary', [RoomController::class, 'summaryView']);
    Route::post('/summary', [RoomController::class, 'summary']);
});

Route::get('/items',[ItemController::class, 'index']);
Route::post('/items/search', [ItemController::class, 'search']);

Route::get('/sales',[SaleController::class, 'index']);
Route::get('/sales/{sale}/items',[SaleController::class, 'show']);

Route::get('/item_sales',[SaleItemController::class, 'index']);
Route::post('/item_sales',[SaleItemController::class, 'filter']);

Route::get('/items/{item}/add_to_cart', [ItemController::class, 'addToCart']);
Route::get('/items/cart', [ItemController::class, 'cart']);
Route::get('/cart/clear', [ItemController::class, 'clearCart']);
Route::get('/cart/{cart}/remove', [ItemController::class, 'removeItemFromCart']);
Route::post('/cart/checkout', [ItemController::class, 'checkout']);

Route::get('/rooms',[RoomController::class, 'index']);
Route::get('/rooms/{room}/transactions',[RoomController::class, 'transactions']);
Route::get('/rooms/{room}/checkin', [RoomController::class, 'checkinShow']);
Route::post('/checkin/{room}', [RoomController::class, 'checkin']);
Route::get('/rooms/{room}/checkout', [RoomController::class, 'checkoutShow']);
Route::post('/checkout/{room}', [RoomController::class, 'checkout']);
Route::get('/rooms/{room}/extend', [RoomController::class, 'extendShow']);
Route::post('/extend/{room}', [RoomController::class, 'extend']);

Route::get('/rooms/transactions',[RoomController::class, 'room_transactions']);
Route::post('/rooms/transactions',[RoomController::class, 'room_transactions']);

Route::get('/room_pricings',[RoomPricingController::class, 'index']);

