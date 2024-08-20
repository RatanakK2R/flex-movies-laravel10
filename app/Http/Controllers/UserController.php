<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
$users = User::all();

class UserController extends Controller
{
    public function index()
        {
            $users = User::all(); // Retrieve all users
            return view('users') -> with('users', $users);
                // return view('user', ["user" => $photos] );
        }
}
