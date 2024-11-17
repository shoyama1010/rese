<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\CsvImportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

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

    Route::get('/shop/{shopId}/reviews', [ReviewController::class, 'showReviewsByShop'])->name('reviews.by_shop');
    // 口コミ投稿画面の表示
    Route::get('/shops/{shop}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    // 口コミを保存
    Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // 口コミを編集
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    // 口コミを更新
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    // 口コミを削除
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // 一般ユーザーがアクセスする決済関連のルート
    Route::get('/checkout', [PaymentController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [PaymentController::class, 'processPayment'])->name('checkout.process');

    // Route::get('/users/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
});


Route::middleware('auth:admin')->group(function () {
    // 管理者用ダッシュボード
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // CSVアップロード専用のルート
    Route::get('/admin/upload-csv', [CsvImportController::class, 'showUploadForm'])->name('admin.upload_csv');
    Route::post('/admin/upload-csv', [CsvImportController::class, 'importCsv'])->name('admin.upload_csv.post');
});

// オーナー用ログインとダッシュボードへのルート
Route::prefix('owner')->group(function () {
    Route::get('/login', [App\Http\Controllers\Owner\Auth\LoginController::class, 'showLoginForm'])->name('owner.login');
    Route::post('/login', [App\Http\Controllers\Owner\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Owner\Auth\LoginController::class, 'logout'])->name('owner.logout');

    // 店舗代表者専用の管理画面用ルート
    Route::middleware('auth:owner')->group(function () {
        Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');

        // Route::resource('owner/shops', ShopsController::class); // 店舗代表者が店舗情報を管理
        // Route::resource('owner/reservations', ReservationsController::class); // 店舗代表者が予約情報を管理
    });
});
    // 管理者用ログインルート
Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
});

require __DIR__ . '/auth.php';
