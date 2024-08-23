<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer|min:1900|max:'.date('Y'),
            'duration' => 'required|integer|min:1',
            'quality' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'string',
            'language' => 'required|array',
            'type' => 'required|in:movie,tv_show', // Ensure this matches the form values
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'video_url' => 'nullable|mimes:mp4,mov,avi,wmv|max:102400',
        ]);

        $movie = new Movie();
        $movie->title = $validatedData['title'];
        $movie->description = $validatedData['description'];
        $movie->release_year = $validatedData['release_year'];
        $movie->duration = $validatedData['duration'];
        $movie->quality = $validatedData['quality'];
        $movie->language = json_encode($validatedData['language']);
        $movie->type = $validatedData['type'];

        // Handle cover image upload
    if ($request->hasFile('cover_image')) {
        $coverImagePath = $request->file('cover_image')->store('cover_images', 'public');
        $movie->cover_image = Storage::url($coverImagePath);
    }

    // Handle video upload
    if ($request->hasFile('video_url')) {
        $videoPath = $request->file('video_url')->store('videos', 'public');
        $movie->video_url = Storage::url($videoPath);
    }

    $movie->save();

    return redirect()->route('movies.index')->with('success', 'Movie created successfully.');

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
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'categories' => 'required|array',
            'actors' => 'required|array',
            'language' => 'required|array',
            // other fields validation...
        ]);

        // Update the movie details
        $movie->update($validated);

        // Sync the many-to-many relationships
        $movie->categories()->sync($request->categories);
        $movie->actors()->sync($request->actors);

        // Redirect back to the movies index
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
    }

}