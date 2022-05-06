<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ReservationsController;

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class,'getLogout']);
});

Route::get('/', [ShopsController::class,'getIndex']);
Route::get('/search', [ShopsController::class,'searchShops']);

Route::get('/detail/{shop_id}', [ShopsController::class,'getDetail']);

Route::get('/like/{shop_id}', [LikesController::class,'like']);
Route::get('/unlike/{shop_id}', [LikesController::class,'unlike']);

Route::get('/register', [AuthController::class,'getRegister']);
Route::post('/register', [AuthController::class,'postRegister']);

Route::get('/mypage', [UsersController::class,'getMypage']);

Route::get('/login', [AuthController::class,'getLogin'])->name('login');;
Route::post('/login', [AuthController::class,'postLogin']);

Route::get('/reservation', function () {
    return view('reservation');
});
Route::post('/reservation', [ReservationsController::class,'reservation']);

Route::get('/cancel/{reservation_id}', [ReservationsController::class,'cancel']);

Route::get('/thanks', function () {
    return view('thanks');
});
