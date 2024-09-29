<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
// ユーティリティクラス `Str` をインポート。ランダムな文字列を生成するために使用。

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;
    // このファクトリが生成するモデルが `User` モデルであることを指定している。

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    // このメソッドは、テストやシーディング時にこのメソッドが呼び出され、ユーザーモデルのインスタンスが生成される

    {
        return [
            'name' => $this->faker->name(),
             // ダミーユーザーの名前を生成。`faker` を使ってランダムな名前を生成。
            //  (faker はデータ生成のためのライブラリで、Laravelに組み込まれています。)
            'email' => $this->faker->unique()->safeEmail(),
            // ランダムで一意な安全なメールアドレスを生成。
            // (unique() メソッドにより、重複しない値が生成されます。)
            'email_verified_at' => now(),
            // ユーザーのメールアドレスが確認された日付を現在時刻で設定。
             // パスワードをハッシュ化したものを設定。ここではプレーンなパスワード 'password' がハッシュ化されて保存される。
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

            // ランダムに生成された10文字の「remember_token」を設定。セッション保持用のトークン
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        // メールアドレスが未確認である状態を設定するメソッド。
        return $this->state(function (array $attributes) {
            // `email_verified_at` を `null` に設定し、メール未確認状態を表す
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
