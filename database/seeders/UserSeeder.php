<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class UserSeeder extends Seeder
{
    /**
     * Create the initial academy users.
     */
    public function run(): void
    {
        $defaultPassword = env('ACADEMY_DEFAULT_PASSWORD');

        if (blank($defaultPassword)) {
            throw new RuntimeException(
                'Please set ACADEMY_DEFAULT_PASSWORD in your .env file.'
            );
        }

        $users = [
            [
                'name' => 'مدیر کل آکادمی',
                'email' => 'admin@example.com',
                'role' => 'super_admin',
            ],
            [
                'name' => 'مدیر آکادمی',
                'email' => 'manager@academy.local',
                'role' => 'admin',
            ],
            [
                'name' => 'کارمند شماره یک',
                'email' => 'employee1@academy.local',
                'role' => 'employee',
            ],
            [
                'name' => 'کارمند شماره دو',
                'email' => 'employee2@academy.local',
                'role' => 'employee',
            ],
            [
                'name' => 'کارمند شماره سه',
                'email' => 'employee3@academy.local',
                'role' => 'employee',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrNew([
                'email' => $data['email'],
            ]);

            $isNewUser = ! $user->exists;

            $user->name = $data['name'];
            $user->role = $data['role'];

            if ($isNewUser) {
                $user->password = Hash::make($defaultPassword);
            }

            $user->save();
        }
    }
}
