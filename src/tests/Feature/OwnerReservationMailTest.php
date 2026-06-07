<?php

namespace Tests\Feature;

use App\Mail\ReservationNotificationMail;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Owner;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OwnerReservationMailTest extends TestCase
{
    use RefreshDatabase;

    private function createOwnerShopReservation()
    {
        $owner = Owner::create([
            'name' => '店舗代表者',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => '予約ユーザー',
            'email' => 'user@example.com',
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
            'name' => 'テスト店舗',
            'description' => 'テスト説明',
            'image_url' => 'test.jpg',
        ]);

        $owner->update([
            'shop_id' => $shop->id,
        ]);

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'date' => '2026-06-10',
            'time' => '18:00:00',
            'user_num' => 2,
            // 'number' => 2,
        ]);

        return compact('owner', 'user', 'shop', 'reservation');
    }

    public function test_店舗代表者は予約一覧を閲覧できる()
    {
        $data = $this->createOwnerShopReservation();

        $this->actingAs($data['owner'], 'owner');

        $response = $this->get(route('owner.reservations.index'));

        $response->assertStatus(200);
        $response->assertSee('テスト店舗');
    }

    public function test_店舗代表者は予約者へメール送信できる()
    {
        Mail::fake();

        $data = $this->createOwnerShopReservation();

        $this->actingAs($data['owner'], 'owner');

        $response = $this->post(
            route('owner.reservations.send_mail', $data['reservation']->id)
        );

        $response->assertRedirect(route('owner.reservations.index'));
        $response->assertSessionHas('success', '予約者へメールを送信しました。');

        Mail::assertSent(ReservationNotificationMail::class, function ($mail) use ($data) {
            return $mail->reservation->id === $data['reservation']->id;
        });
    }

    public function test_他店舗の予約にはメール送信できない()
    {
        Mail::fake();

        $data = $this->createOwnerShopReservation();

        $otherOwner = Owner::create([
            'name' => '別店舗代表者',
            'email' => 'other@example.com',
            'password' => Hash::make('password'),
        ]);

        $otherShop = Shop::forceCreate([
            'area_id' => $data['shop']->area_id,
            'genre_id' => $data['shop']->genre_id,
            'name' => '別店舗',
            'description' => '別店舗説明',
            'image_url' => 'other.jpg',
        ]);

        $otherOwner->update([
            'shop_id' => $otherShop->id,
        ]);

        $this->actingAs($otherOwner, 'owner');

        $response = $this->post(
            route('owner.reservations.send_mail', $data['reservation']->id)
        );

        $response->assertStatus(404);

        Mail::assertNothingSent();
    }
}
