
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            // اطلاعات هویتی
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile', 20);
            $table->string('national_code', 10)->nullable();

            // اطلاعات تماس و تخصص
            $table->string('email')->nullable();
            $table->string('specialty')->nullable();
            $table->text('bio')->nullable();

            // اطلاعات بانکی
            $table->string('card_number', 16)->nullable();
            $table->string('sheba_number', 26)->nullable();

            // وضعیت همکاری
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
