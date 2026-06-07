<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ReviewFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createUserAndShop()
    {
        $user = User::create([
            'name' => '口コミユーザー',
            'email' => 'review@example.com',
            'password' => Hash::make('password'),
        ]);

        $area = Area::forceCreate([
            'name' => '東京都',
        ]);

        $genre = Genre::forceCreate([
            'name' => '寿司',
        ]);

        $shop = Shop::forceCreate([
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'name' => '口コミテスト店舗',
            'description' => '口コミテスト説明',
            'image_url' => 'test.jpg',
        ]);

        return compact('user', 'shop');
    }

    public function test_ログインユーザーは口コミを投稿できる()
    {
        $data = $this->createUserAndShop();

        $this->actingAs($data['user']);

        $response = $this->post(route('reviews.store', $data['shop']->id), [
            'rating' => 5,
            'review_text' => 'とても良いお店でした。',
        ]);

        $response->assertRedirect(route('reviews.by_shop', $data['shop']->id));

        $this->assertDatabaseHas('reviews', [
            'user_id' => $data['user']->id,
            'shop_id' => $data['shop']->id,
            'rating' => 5,
            'review_text' => 'とても良いお店でした。',
        ]);
    }

    public function test_ログインユーザーは自分の口コミを更新できる()
    {
        $data = $this->createUserAndShop();

        $review = Review::create([
            'user_id' => $data['user']->id,
            'shop_id' => $data['shop']->id,
            'rating' => 3,
            'review_text' => '更新前の口コミです。',
        ]);

        $this->actingAs($data['user']);

        $response = $this->put(route('reviews.update', $review->id), [
            'rating' => 4,
            'review_text' => '更新後の口コミです。',
        ]);

        // $response->assertRedirect(route('reviews.by_shop', ['shopId' => $data['shop']->id]));
        $response->assertRedirect(route('shop.detail', $data['shop']->id));
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'rating' => 4,
            'review_text' => '更新後の口コミです。',
        ]);
    }

    public function test_ログインユーザーは自分の口コミを削除できる()
    {
        $data = $this->createUserAndShop();

        $review = Review::create([
            'user_id' => $data['user']->id,
            'shop_id' => $data['shop']->id,
            'rating' => 3,
            'review_text' => '削除する口コミです。',
        ]);

        $this->actingAs($data['user']);

        $response = $this->delete(route('reviews.destroy', $review->id));

        $response->assertRedirect(route('reviews.by_shop', ['shopId' => $data['shop']->id]));

        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id,
        ]);
    }
}
