<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Field $field)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user already reviewed this field
        $existingReview = Review::where('user_id', Auth::id())
            ->where('field_id', $field->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk lapangan ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'field_id' => $field->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update field average rating
        $newRating = $field->reviews()->avg('rating');
        $field->update(['rating' => $newRating]);

        return back()->with('success', 'Terima kasih! Ulasan Anda telah berhasil ditambahkan.');
    }
}
