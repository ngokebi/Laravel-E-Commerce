<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
