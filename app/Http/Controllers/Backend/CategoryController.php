<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;

class CategoryController extends Controller
{
    public function Category()
    {
        $category = Category::latest()->get();

        return view('admin.pages.category.category', compact('category'));
    }

    public function AddCategory()
    {

        return view('admin.pages.category.add');
    }

    public function StoreCategory(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required',
                'category_icon' => 'required',
            ],

            [
                'category_name.required' => 'Please input a Category Name',
                'category_icon.required' => 'Please input a Category Icon',
            ]

        );

        Category::insert([
            'category_name' => $request->category_name,
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.category')->with('success', 'Category Inserted Successfully');
    }

    public function EditCategory($id)
    {
        $edit_category = Category::findOrFail($id);

        return view('admin.pages.category.edit', compact('edit_category'));
    }

    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;

        $validated = $request->validate(
            [
                'category_name' => 'required',
                'category_icon' => 'required',
            ],

            [
                'category_name.required' => 'Please input a Category Name',
                'category_icon.required' => 'Please input a Category Icon',
            ]
        );

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function DeleteCategory($id)
    {

        Category::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Category Deleted Successfully');
    }

}
