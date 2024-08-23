<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */

    //  public function __construct()
    //  {
    //     $this->middleware(['auth']);
    //  }
    // public function __invoke(Request $request)
    // {
    //     return view('dashboard');
    // }
    public function index()
    {
        $totalMovies = Movie::count();
        $totalReviews = Review::count();
        $totalComment = Comment::count();
        $totalUsers = User::count();
        $recentComments = Comment::latest()->limit(5)->get(); // Fetch recent comments

        return view('dashboard.index', compact('totalMovies', 'totalReviews', 'totalUsers', 'totalComment', 'recentComments'));
    }

}
