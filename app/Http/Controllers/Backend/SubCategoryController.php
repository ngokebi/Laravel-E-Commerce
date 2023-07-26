<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use Image;
use Auth;

class SubCategoryController extends Controller
{
    public function SubCategory()
    {
        $sub_category = SubCategory::latest()->get();

        return view('admin.pages.subcategory.subcategory', compact('sub_category'));
    }

    public function AddSubCategory()
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('admin.pages.subcategory.add', compact('categories'));
    }

    public function StoreSubCategory(Request $request)
    {
        $validated = $request->validate(
            [
                'category_id' => 'required',
                'subcategory_name' => 'required',
            ],

            [
                'category_id.required' => 'Please Select Any Option',
                'subcategory_name.required' => 'Please input a SubCategory Name',
            ]

        );

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.subcategory')->with('success', 'SubCategory Inserted Successfully');
    }

    public function EditSubCategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $edit_subcategory = SubCategory::findOrFail($id);

        return view('admin.pages.subcategory.edit', compact('edit_subcategory', 'categories'));
    }

    public function UpdateSubCategory(Request $request)
    {
        $subcategory_id = $request->id;

        $validated = $request->validate(
            [
                'category_id' => 'required',
                'subcategory_name' => 'required',
            ],

            [
                'category_id.required' => 'Please Select Any Option',
                'subcategory_name.required' => 'Please input a SubCategory Name',
            ]
        );

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.subcategory')->with('success', 'SubCategory Updated Successfully');
    }

    public function DeleteSubCategory($id)
    {

        SubCategory::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'SubCategory Deleted Successfully');
    }



    // All Sub Sub_Category Functions

    public function Sub_SubCategory()
    {
        $sub_subcategory = SubSubCategory::latest()->get();

        return view('admin.pages.sub_subcategory.sub_subcategory', compact('sub_subcategory'));
    }

    public function AddSub_SubCategory()
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('admin.pages.sub_subcategory.add', compact('categories'));
    }

    public function Get_SubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();

        return json_encode($subcat);
    }

    public function StoreSub_SubCategory(Request $request)
    {
        $validated = $request->validate(
            [
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'subsubcategory_name' => 'required',
            ],

            [
                'category_id.required' => 'Please Select Any Option',
                'subcategory_id.required' => 'Please Select Any Option',
                'subsubcategory_name.required' => 'Please input a Sub_SubCategory Name',
            ]

        );

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.sub_subcategory')->with('success', 'SubSubCategory Inserted Successfully');
    }

    public function EditSub_SubCategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $edit_subsubcategory = SubSubCategory::findOrFail($id);

        return view('admin.pages.sub_subcategory.edit', compact('edit_subsubcategory', 'categories', 'subcategories'));
    }

    public function UpdateSub_SubCategory(Request $request)
    {
        $subsubcategory_id = $request->id;

        $validated = $request->validate(
            [
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'subsubcategory_name' => 'required',
            ],

            [
                'category_id.required' => 'Please Select Any Option',
                'subcategory_id.required' => 'Please Select Any Option',
                'subsubcategory_name.required' => 'Please input a Sub_SubCategory Name',
            ]
        );

        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.sub_subcategory')->with('success', 'SubSubCategory Updated Successfully');
    }

    public function DeleteSub_SubCategory($id)
    {

        SubSubCategory::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'SubSubCategory Deleted Successfully');
    }

    public function Get_SubSubCategory($subcategory_id)
    {
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();

        return json_encode($subsubcat);
    }
}
