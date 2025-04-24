<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;

class CheckAdminCommand extends Command
{
    protected $signature = 'admin:check';
    protected $description = 'التحقق من المشرفين في قاعدة البيانات';

    public function handle()
    {
        $admins = Admin::all();
        $this->info('عدد المشرفين: ' . $admins->count());
        foreach ($admins as $admin) {
            $this->line('المشرف: ' . $admin->name . ' (ID: ' . $admin->id . ')');
        }
    }
} 