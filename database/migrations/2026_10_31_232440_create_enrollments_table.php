
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // ارتباط با دانشجو و دوره
            $table->foreignId('student_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('course_id')
                ->constrained()
                ->restrictOnDelete();

            // اطلاعات ثبت‌نام
            $table->date('enrolled_at');
            $table->unsignedBigInteger('tuition_amount');
            $table->unsignedBigInteger('discount_amount')->default(0);

            // وضعیت ثبت‌نام
            $table->string('status')->default('in_progress');

            // توضیحات
            $table->text('description')->nullable();

            // جلوگیری از ثبت‌نام تکراری در یک دوره
            $table->unique(['student_id', 'course_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
