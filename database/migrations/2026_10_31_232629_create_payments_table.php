
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // ثبت‌نام مربوط به پرداخت
            $table->foreignId('enrollment_id')
                ->constrained()
                ->restrictOnDelete();

            // اطلاعات پرداخت
            $table->date('paid_at');

            // مبالغ دریافتی
            $table->unsignedBigInteger('cash_amount')->default(0);
            $table->unsignedBigInteger('card_amount')->default(0);

            // اطلاعات تراکنش
            $table->string('tracking_code')->nullable();
            $table->string('receipt_path')->nullable();

            // توضیحات
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
