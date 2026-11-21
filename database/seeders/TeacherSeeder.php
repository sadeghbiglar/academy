<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::create([
            'first_name' => 'علی',
            'last_name' => 'محمدی',
            'mobile' => '09120000001',
            'national_code' => '1234567890',
            'email' => 'ali@example.com',
            'specialty' => 'برنامه‌نویسی وب',
            'bio' => 'مدرس دوره‌های برنامه‌نویسی',
            'card_number' => '6037991234567890',
            'sheba_number' => 'IR123456789012345678901234',
            'is_active' => true,
        ]);

        Teacher::create([
            'first_name' => 'مریم',
            'last_name' => 'احمدی',
            'mobile' => '09120000002',
            'national_code' => '1234567891',
            'email' => 'maryam@example.com',
            'specialty' => 'طراحی وب',
            'bio' => 'مدرس طراحی رابط کاربری',
            'card_number' => '6037991234567891',
            'sheba_number' => 'IR123456789012345678901235',
            'is_active' => true,
        ]);
    }
}