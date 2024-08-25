<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $totalComments = Comment::count();
        $comments = Comment::with('movie', 'user')->paginate(8);
        return view('comments.index', compact('comments'));
    }

    public function show()
    {
        $totalComments = Comment::count();
        $reviews = Comment::orderByDesc('id')->take(8)->get();
        return view('movies.detail', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'text' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'text' => $request->text,
        ]);

        return redirect()->route('detail', ['id' => $request->movie_id])->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully');
    }
}
