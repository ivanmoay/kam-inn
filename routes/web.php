<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
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
    return view('index');
});

Route::get('/users',[UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

Route::get('/items',[ItemController::class, 'index']);
Route::get('/items/create', [ItemController::class, 'create']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{item}/edit', [ItemController::class, 'edit']);
Route::put('/items/{item}', [ItemController::class, 'update']);
Route::delete('/items/{item}', [ItemController::class, 'destroy']);

Route::get('/items/{item}/add_to_cart', [ItemController::class, 'addToCart']);
Route::get('/items/cart', [ItemController::class, 'cart']);

Route::get('/rooms',[RoomController::class, 'index']);
Route::get('/rooms/create', [RoomController::class, 'create']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{room}/edit', [RoomController::class, 'edit']);
Route::put('/rooms/{room}', [RoomController::class, 'update']);
Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

Route::get('/room_pricings',[RoomPricingController::class, 'index']);
Route::get('/room_pricings/create', [RoomPricingController::class, 'create']);
Route::post('/room_pricings', [RoomPricingController::class, 'store']);
Route::get('/room_pricings/{room_pricing}/edit', [RoomPricingController::class, 'edit']);
Route::put('/room_pricings/{room_pricing}', [RoomPricingController::class, 'update']);
Route::delete('/room_pricings/{room_pricing}', [RoomPricingController::class, 'destroy']);
