<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

try {
    $admins = DB::table('admins')->get();
    echo "عدد المشرفين: " . count($admins) . "\n";
    foreach ($admins as $admin) {
        echo "المشرف: " . $admin->name . " (ID: " . $admin->id . ")\n";
        echo "البريد الإلكتروني: " . $admin->email . "\n";
        echo "تاريخ الإنشاء: " . $admin->created_at . "\n";
        echo "------------------------\n";
    }
} catch (\Exception $e) {
    echo "حدث خطأ: " . $e->getMessage() . "\n";
} 