<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact'); // تأكد أن لديك ملف `contact.blade.php` في مجلد `resources/views`
    }
}
