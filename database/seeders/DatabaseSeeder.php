<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InsuranceRequest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class
        ]);

        // إضافة طلبات تأمين تجريبية
        InsuranceRequest::create([
            'name' => 'أحمد محمد',
            'email' => 'ahmed@example.com',
            'military_id' => '123456',
            'unified_number' => 'UN123456',
            'phone' => '0501234567',
            'service_type' => 'new',
            'description' => 'طلب تأمين جديد',
            'hiring_date' => now()
        ]);

        InsuranceRequest::create([
            'name' => 'فاطمة علي',
            'email' => 'fatima@example.com',
            'military_id' => '789012',
            'unified_number' => 'UN789012',
            'phone' => '0507890123',
            'service_type' => 'add-spouse',
            'description' => 'إضافة زوجة للتأمين',
            'hiring_date' => now()
        ]);

        InsuranceRequest::create([
            'name' => 'خالد عبدالله',
            'email' => 'khaled@example.com',
            'military_id' => '345678',
            'unified_number' => 'UN345678',
            'phone' => '0503456789',
            'service_type' => 'add-children',
            'description' => 'إضافة أبناء للتأمين',
            'hiring_date' => now()
        ]);
    }
}
