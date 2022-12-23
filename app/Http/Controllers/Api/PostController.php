<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $news = Post::with('category')->with('tags');

        if (! empty($request->input('category'))) {
            $news = $news->where('category_id', $request->input('category'));
        }

        $news = $news->orderByDesc('id')->get();

        return $news;
    }

    public function get_categories()
    {
        return Category::orderByDesc('id')->get();
    }
}
