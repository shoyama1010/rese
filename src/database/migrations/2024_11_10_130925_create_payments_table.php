<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
            $table->foreignId('shop_id')->nullable()->constrained()->onDelete('cascade'); // 店舗ID（オプション）
            $table->string('stripe_payment_id')->unique(); // Stripeの支払いID
            $table->decimal('amount', 8, 2); // 決済金額
            $table->string('currency')->default('JPY'); // 通貨（デフォルトはJPY）
            $table->string('status'); // 決済ステータス（例：成功、失敗、保留など）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
