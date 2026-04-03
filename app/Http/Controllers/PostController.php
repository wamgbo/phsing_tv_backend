<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // 務必引入加密工具

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('pages.result', compact('posts'));
    }
    public function loginSubmit(Request $request)
    {
        $posts = $request->all();
        error_log(print_r($posts, true));
        Post::create([
            'username' => $posts['username'],
            'password' => Hash::make($posts['password']),
        ]);
        $temp = Post::index();
        error_log(print_r($temp, true));
        return view('pages.result', ['posts' => $posts]);
    }
    public function loginView()
    {
        return view('pages.login');
    }
}
