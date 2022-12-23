<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        $categories = Category::orderByDesc('id')->get();
        $tags = Tag::orderByDesc('id')->get();

        return view('admin/post/list', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }

    public function new(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'slug' => [
                'required',
                function ($attribute, $value, $fail) {
                    $value = $this->maybe_add_slash_at_first($value);
                    if (! preg_match("/(?<!\/nl)\/article\/[^\d]/", $value)) {
                        $fail('The '.$attribute.' is invalid.');
                    }
                },
            ],
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category');
        $post->slug = $this->maybe_add_slash_at_first($request->input('slug'));
        $post->is_selected = ! empty($request->input('is_selected'));

        $post->save();

        $post->tags()->attach($request->input('tags'));

        if (empty($post->id)) {
            return redirect()->back()->with('danger', 'The post was not added successfully.');
        }

        return redirect()->back()->with('success', 'The post was added successfully.');
    }

    public function maybe_add_slash_at_first($url)
    {
        $first_letter = substr($url, 0, 1);

        if ($first_letter !== '/') {
            $url = '/'.$url;
        }

        return $url;
    }
}
