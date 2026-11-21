<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::with('student', 'course')->get();

        foreach ($enrollments as $enrollment) {
            Payment::updateOrCreate(
                [
                    'enrollment_id' => $enrollment->id,
                    'tracking_code' => 'PAY-' . $enrollment->id . '-01',
                ],
                [
                    'paid_at' => '2026-11-05',
                    'cash_amount' => 1000000,
                    'card_amount' => 1500000,
                    'description' => 'قسط اول شهریه دوره',
                ]
            );
        }
    }
}