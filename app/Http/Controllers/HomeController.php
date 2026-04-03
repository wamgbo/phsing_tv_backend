<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            // 如果已登入，顯示會員版首頁
            return view('pages.home_login');
        }

        // 否則顯示一般訪客版
        return view('pages.home_logout');
    }
}
