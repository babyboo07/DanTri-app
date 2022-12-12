<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function adminPage()
    {
        return view('admin.dashboard');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.home');
    }


    public function page()
    {
        $text = '';
        $articleList = [];
        $categories = Category::where("status", 1)->get();
        return view('client.search', compact('categories', 'text', 'articleList'));
    }

    public function searchPage(Request $request)
    {
        $text = '';
        $articleList = [];
        $categories = Category::where("status", 1)->get();
        if ($request->search) {
            $text  = $request->search;
            if ($request->cate_id) {
                $articleList = Post::where('title', 'LIKE', '%' . $text . '%')
                    ->where('cate_id', $request->cate_id)->where('status', 2)->get();
            } else {
                $articleList = Post::where('title', 'LIKE', '%' . $text . '%')
                    ->where('status', 2)->get();
            }
        }

        return view('client.search', compact('categories', 'text', 'articleList'));
    }
}
