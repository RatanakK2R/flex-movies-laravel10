<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::middleware('isAdmin')->group( function () {
//     Route::get('/dashboard', function () { return view('dashboard');}) -> middleware('isAdmin');
//     // Route::get('/dashboard', DashboardController::class)->middleware(['auth']);
//     // Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'admin',])->name('dashboard');

//Movies Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'admin',]);

Route::get('/', function () {
    $movies = Movie::all();
    $categories = Category::all();

    return view('home', ['movies' => $movies, 'categories' => $categories]);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// Profile Routes
Route::get('/profile', ProfileController::class)->name('profile');
Route::get('profile-info', ProfileController::class)->name('edit-user');

// Member Routes
// Route::resource('members', MemberController::class);

Route::get('/subscribe', function () {
    return view('subscribe');
})->name('subscribe');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::resource('users', UserController::class);

// Route::get('/comment', function () {
//     return view('comment');
// })->name('comment');

Route::get('/review', function () {
    return view('review');
})->name('review');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Movies Routes
Route::resource('movies', MovieController::class);
Route::post('movies/create', [App\Http\Controllers\MovieController::class, 'create']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

//Movies Comment
Route::post('movies/detail', [CommentController::class, 'store'])->name('comments.store');
Route::resource('comments', CommentController::class);

//Movies Reeview
Route::resource('reviews', ReviewController::class);
Route::post('movies/detail', [ReviewController::class, 'store'])->name('reviews.store');

//Update Status
Route::patch('/movies/{id}/update-status', [MovieController::class, 'updateStatus'])->name('movies.updateStatus');
Route::get('detail/{id}', [MovieController::class, 'show'])->name('detail');

//Movie detail
//Route::get('detail/{id}', function ($id) {
//    $movie = Movie::with('categories','comments.user', 'reviews.user')->findOrFail($id);
//
//    $categories = $movie->categories;
//    $movies = Movie::all();
//    $comments = $movie->comments; // Retrieve comments
//    $reviews = $movie->reviews;
//
//    return view('movies/detail', ['movie' => $movie, 'categories' => $categories, 'movies' => $movies, 'comments' => $comments, 'reviews' => $reviews]);
//})->name('detail');

Route::get('detail/{id}', [MovieController::class, 'show'])->name('detail');

Route::get('category/{id}', function ($id) {
    $category = Category::findOrFail($id);
    $movies = $category->movies; // Assuming you have a relationship set up
    return view('movies.detail', ['category' => $category, 'movies' => $movies]);
})->name('category.show');
