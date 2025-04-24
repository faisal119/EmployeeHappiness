<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing admins
        Admin::truncate();

        // Create default admin
        Admin::create([
            'name' => 'مدير النظام',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);
    }
}
