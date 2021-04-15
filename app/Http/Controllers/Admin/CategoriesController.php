<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent_category')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all('name', 'id')->toJson();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'parent_category_id' => $request->parentCategory,
        ]);

        return response()->json([
            'message' => 'Category created successfully!'
        ]);
    }
}
