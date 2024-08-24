<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slider_movies = Movie::orderByDesc('id')->take(5)->get();

        $years = Movie::select('release_year')->distinct()->pluck('release_year');

        $categories = Category::all();
        // Fetch movies to display on the home page (you can customize the query as needed)
        $movies = Movie::all(); // Or use a more specific query, like `latest()->take(12)->get();`

        return view('home', get_defined_vars());
        
        // Pass the data to the home view
        // return view('home', compact('movies'));
    }
}
