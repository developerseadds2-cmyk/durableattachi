<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();
        if ($request->filled('search')) {
            $query->where(function ($subQuery) use ($request) {
                $term = '%' . $request->search . '%';
                $subQuery->where('name', 'like', $term)->orWhere('email', 'like', $term)->orWhere('subject', 'like', $term);
            });
        }
        if ($request->filled('status')) $query->where('is_read', $request->status === 'read');
        if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
        if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);
        $contacts = $query->paginate(20)->withQueryString();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}
