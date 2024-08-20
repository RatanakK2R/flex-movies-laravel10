<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Actor;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        // Search
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        // Sorting
        $sortBy = $request->input('sort', 'created_at');
        if ($sortBy === 'rating') {
            $query->orderBy('rating', 'desc');
        } elseif ($sortBy === 'views') {
            $query->orderBy('views', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $movies = $query->with('categories', 'actors')->paginate(10);

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('movies.create', compact('categories', 'actors'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'release_year' => 'required|integer',
            'duration' => 'nullable|integer',
            'quality' => 'nullable|string',
            'language' => 'nullable|array', // Expect an array for language
            'type' => 'required|string',
            'video' => 'nullable|file|mimes:mp4,mkv,avi',
            'watch_link' => 'nullable|url',
            // Add validation for other fields as necessary
        ]);

        // Handle file uploads
        $data = $request->except(['cover', 'language']); // Exclude fields that are handled separately
        $data['language'] = json_encode($request->language); // Convert array to JSON

        $movie = Movie::create($data);

        // Handle the cover image
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $movie->update(['cover' => $coverPath]);
        }

        $movie->categories()->sync($request->categories);
        $movie->actors()->sync($request->actors);

        return redirect()->route('movies.index');
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('movies.edit', compact('movie', 'categories', 'actors'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());
        $movie->categories()->sync($request->categories);
        $movie->actors()->sync($request->actors);
        return redirect()->route('movies.index');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}