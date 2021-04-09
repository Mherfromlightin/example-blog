<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent_category')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::pluck('name', 'id');

        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'parent_category_id' => $request->parent_category_id,
        ]);

        Session::flash('success_message', 'Category created successfully!');

        return redirect()->back();
    }
}
