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
            'categories.*' => 'integer|exists:categories,id',
            'language' => 'required|array',
            'type' => 'required|in:Movie,TV Show,3D',
            'cover_image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
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
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImagePath = $coverImage->storeAs('cover_images', $coverImageName, 'public');
            $movie->cover_image = $coverImageName;
        }

        // Handle video upload
        if ($request->hasFile('video_url')) {
            $video = $request->file('video_url');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $videoPath = $video->storeAs('videos', $videoName, 'public');
            $movie->video_url = $videoName;
        }

        $movie->save();

        // Associate categories with the movie
        $movie->categories()->attach($validatedData['categories']);

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
        return view('movies.show', compact('movies'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|in:Movie,TV Show,3D',
            'categories' => 'required|array',
            'language' => 'required|array',
            'cover_image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'video_url' => 'nullable|mimes:mp4,mov,avi,wmv|max:102400',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            if ($movie->cover_image) {
                Storage::disk('public')->delete('cover_images/' . $movie->cover_image);
            }

            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImagePath = $coverImage->storeAs('cover_images', $coverImageName, 'public');
            $movie->cover_image = $coverImageName;
        }

        // Handle video upload
        if ($request->hasFile('video_url')) {
            // Delete old video if exists
            if ($movie->video_url) {
                Storage::disk('public')->delete('videos/' . $movie->video_url);
            }

            $video = $request->file('video_url');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $videoPath = $video->storeAs('videos', $videoName, 'public');
            $movie->video_url = $videoName;
        }

        // Update the movie details, excluding the file fields
        $movie->update($request->except(['cover_image', 'video_url']));

        // Sync the many-to-many relationships
        $movie->categories()->sync($request->categories);
        $movie->actors()->sync($request->actors);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the movie by ID
        $movie = Movie::findOrFail($id);

        // Toggle the status
        $newStatus = $movie->status === 'Visible' ? 'Hidden' : 'Visible';
        $movie->status = $newStatus;
        $movie->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Movie status updated successfully.');
    }
}
