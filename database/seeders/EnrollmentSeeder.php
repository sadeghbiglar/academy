<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::take(3)->get();

        $phpCourse = Course::where('title', 'آموزش جامع PHP')
            ->firstOrFail();

        $laravelCourse = Course::where('title', 'آموزش Laravel')
            ->firstOrFail();

        foreach ($students as $index => $student) {
            Enrollment::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'course_id' => $phpCourse->id,
                ],
                [
                    'enrolled_at' => '2026-11-01',
                    'tuition_amount' => $phpCourse->tuition_amount,
                    'discount_amount' => 0,
                    'status' => 'in_progress',
                    'description' => 'ثبت‌نام آزمایشی دوره PHP',
                ]
            );

            if ($index < 2) {
                Enrollment::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'course_id' => $laravelCourse->id,
                    ],
                    [
                        'enrolled_at' => '2026-11-02',
                        'tuition_amount' => $laravelCourse->tuition_amount,
                        'discount_amount' => 500000,
                        'status' => 'in_progress',
                        'description' => 'ثبت‌نام آزمایشی دوره Laravel',
                    ]
                );
            }
        }
    }
}