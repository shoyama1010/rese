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
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\PaymentController;

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

    // / 口コミ表示
    // Route::get('/shop/{shop_id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    // Route::get('/shops/{shop}/reviews/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
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
});

// 管理者向けの店舗代表者管理ルート(isAdmin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // 店舗代表者の一覧表示
    Route::get('/admin/owners', [AdminOwnerController::class, 'index'])->name('admin.owners.index');
    // 特定の店舗代表者の詳細表示
    Route::get('/admin/owners/shops/{shop_id}', [AdminOwnerController::class, 'show'])->name('admin.owners.shops.show');
    // 店舗代表者のステータス編集ページ
    Route::get('/admin/owners/{id}/edit-status', [AdminOwnerController::class, 'editStatus'])->name('admin.owners.edit_status');
    // 店舗代表者のステータス更新
    Route::put('/admin/owners/{id}/update-status', [AdminOwnerController::class, 'updateStatus'])->name('admin.owners.update_status');
    // 特定の店舗代表者の店舗一覧表示
    Route::get('/admin/owners/{id}/shops', [AdminOwnerController::class, 'showOwnerShops'])->name('admin.owners.shops');
    // 店舗代表者の削除
    Route::delete('/admin/owners/{id}', [AdminOwnerController::class, 'destroy'])->name('admin.owners.destroy');
});


Route::middleware('auth:admin')->group(function ()
 {
    // 管理者用ダッシュボード
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin/owners', AdminOwnerController::class); // 管理者が店舗代表者を管理
    // CSVアップロード専用のルート
    Route::get('/admin/upload-csv', [CsvImportController::class, 'showUploadForm'])->name('admin.upload_csv');
    Route::post('/admin/upload-csv', [CsvImportController::class, 'importCsv'])->name('admin.upload_csv');
    // Route::post('/admin/import-reservations', [CsvImportController::class, 'importReservations'])->name('admin.import_reservations');

});

    // 店舗代表者専用の管理画面用ルート
Route::middleware('auth:owner')->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::resource('owner/shops', ShopsController::class); // 店舗代表者が店舗情報を管理
    Route::resource('owner/reservations', ReservationsController::class); // 店舗代表者が予約情報を管理
});



require __DIR__ . '/auth.php';
