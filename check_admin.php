<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$admins = \App\Models\Admin::all();
echo "عدد المشرفين: " . $admins->count() . "\n";
foreach ($admins as $admin) {
    echo "المشرف: " . $admin->name . " (ID: " . $admin->id . ")\n";
} 