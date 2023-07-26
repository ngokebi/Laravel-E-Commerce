<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;

class ProductsController extends Controller
{
    public function Products()
    {
        $products = Products::latest()->get();

        return view('admin.pages.products.products', compact('products'));
    }

    public function AddProducts()
    {

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.pages.products.add', compact('categories', 'brands'));
    }

    public function StoreProducts(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'subsubcategory_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_tags' => 'required',
                'product_qty' => 'required',
                'product_size' => 'required',
                'product_color' => 'required',
                'selling_price' => 'required',
                'short_description' => 'required',
                'long_description' => 'required',
                'product_thumbnail' => 'required',
                'photo_image' => 'required',
                'discount_price' => 'required',

            ],

            [
                'brand_id.required' => 'Please Select a Brand',
                'category_id.required' => 'Please Select a Category',
                'subcategory_id.required' => 'Please Select a Sub-Category',
                'subsubcategory_id.required' => 'Please Select a Sub--Category',
                'product_name.required' => 'Please input a Product Name',
                'product_code.required' => 'Please input Product Code',
                'product_qty.required' => 'Please input Product Quantity',
                'discount_price.required' => 'Please input a Discount Price',
                'selling_price.required' => 'Please input a Selling Price',
                'short_description.required' => 'Write a Short Description',
                'long_description.required' => 'Write a Long Description',
                'product_thumbnail.required' => 'Upload an Image',
                'photo_image.required' => 'Upload all Product Images',
            ]

        );

        $product_thumbnail = $request->file('product_thumbnail');

        $name_gen = hexdec(uniqid()) . '.' . $product_thumbnail->getClientOriginalExtension();
        Image::make($product_thumbnail)->save('upload/products/thumbnail/' . $name_gen);

        $product_img = 'upload/products/thumbnail/' . $name_gen;

        $product_id = Products::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_tags' => $request->product_tags,
            'product_qty' => $request->product_qty,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'product_thumbnail' => $product_img,
            'discount_price' => $request->discount_price,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);


        /////////////////// Multiple Image Upload Start ////////////////////////////

        $images = $request->file('photo_image');

        foreach ($images as $img) {
            $photo_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save('upload/products/multi-image/' . $photo_gen);

            $multi_img = 'upload/products/multi-image/' . $photo_gen;

            MultiImage::insert([
                'product_id' => $product_id,
                'photo_name' => $multi_img,
                'created_at' => Carbon::now()
            ]);
        }
        /////////////////// Multiple Image Upload Ends ////////////////////////////

        return Redirect()->route('manage.products')->with('success', 'Product Inserted Successfully');
    }

    public function EditProducts($id)
    {
        $multiImg = MultiImage::where('product_id', $id)->get();
        $edit_product = Products::findOrFail($id);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('admin.pages.products.edit', compact('edit_product', 'brands', 'categories', 'subcategory', 'subsubcategory', 'multiImg'));
    }

    public function UpdateProducts(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'subsubcategory_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_tags' => 'required',
                'product_qty' => 'required',
                'product_size' => 'required',
                'product_color' => 'required',
                'selling_price' => 'required',
                'short_description' => 'required',
                'long_description' => 'required',
                'discount_price' => 'required',

            ],

            [
                'brand_id.required' => 'Please Select a Brand',
                'category_id.required' => 'Please Select a Category',
                'subcategory_id.required' => 'Please Select a Sub-Category',
                'subsubcategory_id.required' => 'Please Select a Sub--Category',
                'product_name.required' => 'Please input a Product Name',
                'product_code.required' => 'Please input Product Code',
                'product_qty.required' => 'Please input Product Quantity',
                'discount_price.required' => 'Please input a Discount Price',
                'selling_price.required' => 'Please input a Selling Price',
                'short_description.required' => 'Write a Short Description',
                'long_description.required' => 'Write a Long Description',
            ]

        );

        $product_id = $request->id;
        Products::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_tags' => $request->product_tags,
            'product_qty' => $request->product_qty,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'discount_price' => $request->discount_price,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.products')->with('success', 'Product Updated Successfully');
    }

    public function UpdateProductImage(Request $request)
    {
        $imgs = $request->photo_image;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save('upload/products/multi-image/' . $make_name);

            $product_img = 'upload/products/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $product_img,
                'updated_at' => Carbon::now()
            ]);
        }
        return Redirect()->route('manage.products')->with('success', 'Product Image Updated Successfully');
    }

    public function UpdateProductMainImage(Request $request)
    {
        $product_id = $request->id;
        $old_image = $request->old_img;

        unlink($old_image);
        $new_img = $request->file('product_thumbnail');
        $new_image = hexdec(uniqid()) . '.' . $new_img->getClientOriginalExtension();
        Image::make($new_img)->save('upload/products/thumbnail/' . $new_image);

        $product_img = 'upload/products/thumbnail/' . $new_image;

        Products::findOrFail($product_id)->update([
            'product_thumbnail' => $product_img,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.products')->with('success', 'Product Main Thumbnail Updated Successfully');
    }

    public function DeleteProductsImages($id)
    {
        $old_image = MultiImage::findOrFail($id);

        unlink($old_image->photo_name);

        MultiImage::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Product Image Deleted Successfully');
    }

    public function Active($id)
    {
        Products::findOrFail($id)->update([
            'status' => 1,
        ]);

        return Redirect()->back()->with('success', 'Product Active');
    }

    public function Inactive($id)
    {
        Products::findOrFail($id)->update([
            'status' => 0,
        ]);

        return Redirect()->back()->with('success', 'Product Inactive');
    }

    public function DeleteProducts($id)
    {
        $product = Products::findOrFail($id);
        unlink($product->product_thumbnail);
        Products::findOrFail($id)->delete();

        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as $image) {
            unlink($image->photo_name);
            MultiImage::where('product_id', $id)->delete();
        }

        return Redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
