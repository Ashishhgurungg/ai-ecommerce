<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
        public function showReviewForm()
    {
        return view('review/review-form');
    }
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
        ]);
        $review = new Review();
        $review->fill($validated);
        $review->save();

        return redirect('/review')->with('success', 'Thank you for your feedback!');
    }

    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect('/reviews')->with('success', 'Review deleted successfully.');
    }

    public function listReviews()
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(6);
        return view('review/review-list', compact('reviews'));
    }
}
