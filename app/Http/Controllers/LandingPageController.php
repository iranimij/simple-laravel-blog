<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\PostController;
use App\Models\Post;

class LandingPageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $js_vars = [
            'mainUrl' => url('/'),
        ];

        return view('landing',
            ['js_vars' => $js_vars],
        );
    }

    public function get_news($slug)
    {
        $post_controller = new PostController();
        $post = Post::where('slug', $post_controller->maybe_add_slash_at_first($slug))->with('category')->with('tags')->first();

        return view('single', ['post' => $post]);
    }
}
