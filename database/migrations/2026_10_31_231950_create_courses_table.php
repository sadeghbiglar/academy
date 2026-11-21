
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // مدرس دوره
            $table->foreignId('teacher_id')
                ->constrained()
                ->restrictOnDelete();

            // اطلاعات دوره
            $table->string('title');
            $table->text('description')->nullable();

            // اطلاعات مالی
            $table->unsignedBigInteger('tuition_amount');

            // زمان‌بندی دوره
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // ظرفیت پذیرش
            $table->unsignedSmallInteger('capacity')->nullable();

            // وضعیت دوره
            $table->string('status')->default('upcoming');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
