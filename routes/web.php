<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

Route::middleware('auth')->group(function () {
    Route::get('/thanks', function () {
        return view('thanks');
    });

    Route::get('/mypage', [UsersController::class, 'mypage'])->name('mypage');

    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    Route::post('/reservation', [ReservationsController::class, 'create'])->name('reserve.create');
    Route::post('/reserve/{reservation_id}', [ReservationsController::class, 'delete'])->name('reserve.delete');
});

require __DIR__ . '/auth.php';
