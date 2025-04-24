<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'store']);
    }

    public function index()
    {
        return view('suggestions');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'military_number' => 'nullable|string|max:50',
            'suggestion' => 'required|string',
        ]);

        $validated['status'] = 'pending';

        Suggestion::create($validated);

        return redirect()->back()->with('success', 'تم إرسال اقتراحك بنجاح. شكراً لك!');
    }

    public function adminIndex()
    {
        try {
            $suggestions = Suggestion::latest()->paginate(10);
            return view('admin.suggestions', compact('suggestions'));
        } catch (\Exception $e) {
            \Log::error('Error in adminIndex: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء تحميل الاقتراحات');
        }
    }

    public function show(Suggestion $suggestion)
    {
        try {
            return view('admin.suggestions.show', compact('suggestion'));
        } catch (\Exception $e) {
            \Log::error('Error in show: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء عرض الاقتراح');
        }
    }

    public function update(Request $request, Suggestion $suggestion)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,reviewed,implemented',
                'admin_notes' => 'nullable|string',
            ]);

            $suggestion->update($validated);

            return redirect()->route('admin.suggestions.index')
                ->with('success', 'تم تحديث حالة الاقتراح بنجاح');
        } catch (\Exception $e) {
            \Log::error('Error in update: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء تحديث الاقتراح');
        }
    }

    public function destroy(Suggestion $suggestion)
    {
        try {
            $suggestion->delete();
            return redirect()->route('admin.suggestions.index')
                ->with('success', 'تم حذف الاقتراح بنجاح');
        } catch (\Exception $e) {
            \Log::error('Error in destroy: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء حذف الاقتراح');
        }
    }
} 