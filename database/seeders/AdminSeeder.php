<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn('Running Admin Seeder!');
        if (Admin::count() === 0) {
            $password = config('constants.user.super-admin.password', 'super@admin.com');
            $hashedPassword = Hash::make($password);
            Config::set('constants.user.super-admin.password', $hashedPassword);
            $admin = config('constants.user.super-admin');
            Admin::create($admin);
        }
        $this->command->warn('Completed Admin Seeder!');
    }
}
