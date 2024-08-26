<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Slider Movies: Most recent 5 movies
        $slider_movies = Movie::orderByDesc('id')->take(5)->get();

        // Distinct Release Years
        $years = Movie::select('release_year')->distinct()->pluck('release_year');

        // All Of Review
        $reviews = Review::all();

        // All Categories
        $categories = Category::all();

        //All Movies
        $movies = Movie::where('status', 'Visible')->get();

        // Paginate Movies for the Home Page
        $pagmovie = Movie::where('status', 'Visible')->orderByDesc('id')->paginate(9);

        // Pass the data to the view
        return view('home', compact('slider_movies', 'years', 'categories', 'movies', 'pagmovie'));
    }
}
