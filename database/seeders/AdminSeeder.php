<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'name' => 'lebah ganteng',
                'email' => 'akmalganteng@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password2'),
            ],
            [
                'name' => 'Admin 3',
                'email' => 'admin3@example.com',
                'password' => Hash::make('password3'),
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['email' => $admin['email']], // Periksa berdasarkan email
                $admin // Update atau insert data
            );
        }
    }
}
