<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();

        return view('admin.pages.coupon.coupon', compact('coupons'));
    }

    public function AddCoupon()
    {

        return view('admin.pages.coupon.add');
    }

    public function StoreCoupon(Request $request)
    {
        $validated = $request->validate(
            [
                'coupon_name' => 'required',
                'discount' => 'required',
                'validity' => 'required',
            ],

            [
                'coupon_name.required' => 'Please input a Coupon Name',
                'discount.required' => 'Please input a Discount',
                'validity.required' => 'Please input a Validity Date',
            ]

        );

        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.coupon')->with('success', 'Coupon Inserted Successfully');
    }

    public function EditCoupon($id)
    {
        $edit_coupon = Coupon::findOrFail($id);

        return view('admin.pages.coupon.edit', compact('edit_coupon'));
    }

    public function UpdateCoupon(Request $request)
    {
        $coupon_id = $request->id;

        $validated = $request->validate(
            [
                'coupon_name' => 'required',
                'discount' => 'required',
                'validity' => 'required',
            ],

            [
                'coupon_name.required' => 'Please input a Coupon Name',
                'discount.required' => 'Please input a Discount',
                'validity.required' => 'Please input a Validity Date',
            ]
        );

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => $request->coupon_name,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('manage.coupon')->with('success', 'Coupon Updated Successfully');
    }

    public function DeleteCoupon($id)
    {

        Coupon::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Coupon Deleted Successfully');
    }

    public function CouponApply(Request $request)
    {
        $coupon_name = $request->coupon_name;

        $coupon = Coupon::where('coupon_name', $coupon_name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        $total = (int)str_replace(',', '', Cart::total());

        if ($coupon) {
            Session::put('coupon', [
                "coupon_name" => $coupon->coupon_name,
                "discount" => $coupon->discount,
                "discount_amount" => round($total * $coupon->discount / 100),
                "total_amount" => round($total - $total * $coupon->discount / 100)
            ]);

            return response()->json(['success' => 'Coupon Applied Successfully']);
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function CouponCalculate()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'cartQty' => Cart::count(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'discount' => session()->get('coupon')['discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount']
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
                'cartQty' => Cart::count()
            ));
        }
    }

    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(["success" => "Coupon has been Removed"]);
    }
}
