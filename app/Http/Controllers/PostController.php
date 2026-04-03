<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('pages.result', compact('posts'));
    }
    public function loginSubmit(Request $request)
    {
        $posts=$request->all();
        $username=$posts['username'];
        $password=$posts['password'];
        return view('pages.result', compact('posts'));
    }
    public function loginView()
    {
        return view('pages.login');
    }
}
