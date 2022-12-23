<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderByDesc('id')->get();

        return view('admin/category/list', ['categories' => $categories]);
    }

    public function new(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category = Category::create(
            [
                'title' => $request->title,
            ]
        );

        if (empty($category->id)) {
            return redirect()->back()->with('danger', 'The category was not added successfully.');
        }

        return redirect()->back()->with('success', 'The category was added successfully.');
    }
}
