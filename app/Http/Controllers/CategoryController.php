<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories()
    {
        return view('admin.category.index');
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255|min:5',
            ],
            [
                'category_name.required' => "Please input category name",
                'category_name.min' => "Category name must be between 5 and 255",
            ]
        );
    }
}
