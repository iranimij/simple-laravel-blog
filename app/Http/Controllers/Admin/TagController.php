<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::orderByDesc('id')->get();

        return view('admin/tag/list', ['tags' => $tags]);
    }

    public function new(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $tag = Tag::create(
            [
                'title' => $request->title,
            ]
        );

        if (empty($tag->id)) {
            return redirect()->back()->with('danger', 'The tag was not added successfully.');
        }

        return redirect()->back()->with('success', 'The tag was added successfully.');
    }
}
