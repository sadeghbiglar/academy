<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $teacher1 = Teacher::where('mobile', '09120000001')->firstOrFail();
        $teacher2 = Teacher::where('mobile', '09120000002')->firstOrFail();

        Course::create([
            'teacher_id' => $teacher1->id,
            'title' => 'آموزش جامع PHP',
            'description' => 'آموزش برنامه‌نویسی PHP از مقدماتی تا پیشرفته',
            'tuition_amount' => 5000000,
            'start_date' => '2026-12-01',
            'end_date' => '2027-02-01',
            'capacity' => 20,
            'status' => 'upcoming',
        ]);

        Course::create([
            'teacher_id' => $teacher1->id,
            'title' => 'آموزش Laravel',
            'description' => 'آموزش فریم‌ورک Laravel به‌صورت پروژه‌محور',
            'tuition_amount' => 7000000,
            'start_date' => '2027-02-10',
            'end_date' => '2027-04-10',
            'capacity' => 15,
            'status' => 'upcoming',
        ]);

        Course::create([
            'teacher_id' => $teacher2->id,
            'title' => 'طراحی رابط کاربری',
            'description' => 'آموزش اصول طراحی رابط کاربری وب',
            'tuition_amount' => 4500000,
            'start_date' => '2026-12-15',
            'end_date' => '2027-02-15',
            'capacity' => 18,
            'status' => 'upcoming',
        ]);
    }
}