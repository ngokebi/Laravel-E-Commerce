<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;

class BrandController extends Controller
{
    public function Brands()
    {
        $brands = Brand::latest()->get();

        return view('admin.pages.brand.brands', compact('brands'));
    }

    public function AddBrands()
    {

        return view('admin.pages.brand.add');
    }

    public function StoreBrands(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],

            [
                'brand_name.required' => 'Please input a Brand Name',
                'brand_image.required' => 'Please input a Brand Image',
            ]

        );

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(166, 110)->save('upload/brand/' . $name_gen);

        $last_img = 'upload/brand/' . $name_gen;


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.brand')->with('success', 'Brand Inserted Successfully');
    }

    public function EditBrands($id)
    {
        $edit_brand = Brand::findOrFail($id);

        return view('admin.pages.brand.edit', compact('edit_brand'));
    }

    public function UpdateBrands(Request $request)
    {
        $brand_id = $request->id;

        $validated = $request->validate(
            [
                'brand_name' => 'required',
                'brand_image' => 'mimes:jpg,jpeg,png',
            ],

            [
                'brand_name.required' => 'Please input a Brand Name',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {

            $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(166, 110)->save('upload/brand/' . $name_gen);

            $last_img = 'upload/brand/' . $name_gen;

            unlink($old_image);
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfully');
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfully');
        }
    }

    public function DeleteBrands($id)
    {

        $image = Brand::findOrFail($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::findOrFail($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }
}
