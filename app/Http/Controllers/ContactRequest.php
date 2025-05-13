<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactRequest extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:5120',
        ]);

        // حفظ البيانات في قاعدة البيانات
        $contact = ContactRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'attachment' => $request->file('attachment') ? $request->file('attachment')->store('attachments', 'public') : null,
        ]);

        // إرسال البريد الإلكتروني
        Mail::to('admin@example.com')->send(new ContactMail($contact));

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}
