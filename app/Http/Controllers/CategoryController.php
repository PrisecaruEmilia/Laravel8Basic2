<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function allCategories()
    {
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(3);


        $categories = Category::latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(3);
        return view('admin.category.index', compact('categories'));
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

        // insert data eloquent ORM
        // 1 approach

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        // 2 approach

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->created_at = Carbon::now();
        // $category->save();


        // insert data query builder

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);


        return Redirect()->back()->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
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

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
        ]);

        return Redirect()->route('all.categories')->with('success', 'Category updated successfully.');
    }
}
