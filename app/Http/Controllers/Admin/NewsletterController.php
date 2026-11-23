<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::latest();
        if ($request->filled('search')) $query->where('email', 'like', '%' . $request->search . '%');
        if ($request->filled('status')) $query->where('status', $request->status === 'active');
        $subscribers = $query->paginate(30)->withQueryString();
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    public function export()
    {
        $emails = Newsletter::where('status', true)->pluck('email')->implode("\n");
        return response($emails, 200, [
            'Content-Type'        => 'text/plain',
            'Content-Disposition' => 'attachment; filename="subscribers.txt"',
        ]);
    }
}
