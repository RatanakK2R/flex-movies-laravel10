<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'movie')->paginate(8);
        return view('reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function create()
    {
        $movies = Movie::all();
        return view('reviews.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'text' => 'required|string',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'text' => $request->text,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review created successfully!');
    }

    public function edit(Review $review)
    {
        $movies = Movie::all();
        return view('reviews.edit', compact('review', 'movies'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'text' => 'required|string',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $review->update([
            'movie_id' => $request->movie_id,
            'text' => $request->text,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }
}
