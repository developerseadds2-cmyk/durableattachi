<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with('product', 'user')->latest();
        if ($request->status) $query->where('status', $request->status);
        if ($request->filled('search')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('body', 'like', '%' . $request->search . '%')
                    ->orWhereHas('product', fn ($product) => $product->where('name', 'like', '%' . $request->search . '%'))
                    ->orWhereHas('user', fn ($user) => $user->where('name', 'like', '%' . $request->search . '%'));
            });
        }
        if ($request->filled('rating')) $query->where('rating', $request->rating);

        $reviews = $query->paginate(20)->withQueryString();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load('product', 'user');
        return view('admin.reviews.show', compact('review'));
    }

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);
        return back()->with('success', 'Review approved successfully.');
    }

    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'rejected']);
        return back()->with('success', 'Review rejected.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted.');
    }
}
