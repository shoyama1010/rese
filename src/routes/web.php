<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\CsvImportController;
use App\Http\Controllers\AdminController;

Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

Route::get('/shop/{shop}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::get('/shops', [ShopsController::class, 'index'])->name('shops.index');
Route::get('/shops/sort', [ShopsController::class, 'sort'])->name('shops.sort');

Route::middleware('auth')->group(function () {
    Route::get('/thanks', function () {
        return view('thanks');
    });
    Route::get('/mypage', [UsersController::class, 'mypage'])->name('mypage');
    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    Route::post('/reservation', [ReservationsController::class, 'create'])->name('reserve.create');
    Route::post('/reserve/{reservation_id}', [ReservationsController::class, 'delete'])->name('reserve.delete');

    // ****** 口コミ関連のルート ************
    // / 口コミを投稿するためのフォーム表示
    Route::get('/shops/{shop}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    // 口コミを保存
    Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // 口コミを編集
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    // 口コミを更新
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    // 口コミを削除
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// 管理モード
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // 管理者用ダッシュボード
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // CSVアップロードのためのルート
    Route::get('/admin/upload-csv', [CsvImportController::class, 'showUploadForm'])->name('admin.upload_csv_form');
    Route::post('/admin/upload-csv', [CsvImportController::class, 'importCsv'])->name('admin.upload_csv');
});

require __DIR__ . '/auth.php';
