<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Products;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        // $brands = DB::table('brands')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $products = Products::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Products::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals = Products::where('hot_deals', 1)->where('discount_price', '!=', null)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offer = Products::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $special_deals = Products::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $skip_category = Category::skip(1)->first();
        $skip_product = Products::where('status', 1)->where('category_id', $skip_category->id)->orderBy('id', 'DESC')->get();
        $skip_category_1 = Category::skip(4)->first();
        $skip_product_1 = Products::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();
        $product_tags = Products::groupBy('product_tags')->select('product_tags')->get();
        // return $skip_product;
        // die();
        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hot_deals', 'special_offer', 'special_deals', 'skip_category', 'skip_product', 'skip_category_1', 'skip_product_1', 'product_tags'));
    }

    public function UserLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.pages.profile', compact('user'));
        return view('frontend.body.profilesiderbar', compact('user'));
    }

    public function UpdateProfile(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ],

        );

        $id = Auth::user()->id;
        $user = User::find($id);

        if ($user) {

            $user->name = $request['name'];
            $user->phone = $request['phone'];
            $user->email = $request['email'];

            $user->save();

            return redirect()->back();
        }
    }

    public function UpdatePicture(Request $request)
    {

        $validated = $request->validate(
            [
                'profile_photo_path' => 'required|mimes:jpg,jpeg,png',
            ],

        );

        $id = Auth::user()->id;
        $user = User::find($id);

        if ($user) {

            if ($request->file('profile_photo_path')) {
                $file = $request->file('profile_photo_path');
                if (file_exists('upload/user_images/' . $user->profile_photo_path)) {
                    @unlink(public_path('upload/user_images/' . $user->profile_photo_path));
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/user_images'), $filename);
                    $user['profile_photo_path'] = $filename;
                } else {
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/user_images'), $filename);
                    $user['profile_photo_path'] = $filename;
                }
            }

            $user->save();

            return redirect()->back();
        }
    }

    public function UpdatePassword(Request $request)
    {
        $validated = $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@_&*%]).*$/|confirmed',
            ],

        );

        $id = Auth::user()->id;

        $hashedPassword = User::find($id)->password;

        if (Hash::check($request->current_password, $hashedPassword)) {

            $user = User::find($id);

            $user->password = Hash::make($request->password);

            $user->save();

            Auth::logout();

            return redirect()->route('user.logout');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function ProductDetails($id, $name)
    {
        $product = Products::findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);
        $size = $product->product_size;
        $product_size = explode(',', $size);
        $mulitiImage = MultiImage::where('product_id', $id)->get();
        $cat_id = $product->category_id;
        $hot_deals = Products::where('hot_deals', 1)->where('discount_price', '!=', null)->orderBy('id', 'DESC')->limit(3)->get();
        $related_product = Products::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.pages.product_details', compact('product', 'mulitiImage', 'product_color', 'product_size', 'related_product', 'hot_deals'));
    }

    public function TagProduct($tag)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Products::where('status', 1)->where('product_tags', $tag)->orderBy('id', 'DESC')->paginate(3);
        return view('frontend.pages.tags', compact('products', 'categories'));
    }

    public function SubCatWIseProduct($subcat_id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Products::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        return view('frontend.pages.subcat_product', compact('products', 'categories'));
    }

    public function SubSubCatWIseProduct($subsubcat_id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Products::where('status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(3);
        return view('frontend.pages.subsubcat_product', compact('products', 'categories'));
    }

    public function ProductViewAjax($id)
    {
        $product = Products::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }
}
