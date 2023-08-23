<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Coupon;
use App\Models\Products;
use App\Models\ShipDivision;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addTocart(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        if ($product->discount_price == null) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 550,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size
                ]
            ]);

            return response()->json(['success' => 'Successfully added to your Cart']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 550,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size
                ]
            ]);

            return response()->json(['success' => 'Successfully added to your Cart']);
        }
    }

    public function miniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    // remove mini cart
    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        Session::flush();
        return response()->json(['success' => 'Product Remove from Cart']);
    }

    public function CartIndex()
    {
        return view('frontend.pages.cart');
    }

    public function getCartItem()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function RemoveCartList($rowId)
    {
        Cart::remove($rowId);
        Session::flush();
        return response()->json(['success' => 'Product Remove from Cart']);
    }

    public function qtyUpdate(Request $request, $rowId)
    {

        $quantity = $request->qty;
        Cart::update($rowId, ['qty' => $quantity]);


        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            $total = (int)str_replace(',', '', Cart::total());

            Session::put('coupon', [
                "coupon_name" => $coupon->coupon_name,
                "discount" => $coupon->discount,
                "discount_amount" => round($total * $coupon->discount / 100),
                "total_amount" => round($total - $total * $coupon->discount / 100)
            ]);
        }
        return response()->json('Quantity Updated');
    }

    // Checkout
    public function Checkout()
    {


        if (Auth::check()) {
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $division = ShipDivision::orderBy('division_name', 'ASC')->get();

                return view('frontend.pages.checkout', compact('carts', 'cartQty', 'cartTotal', 'division'));
            } else {
                return redirect()->to('/');
            }
        } else {
            return redirect()->route('login')->with('error', 'Login to Checkout Items!');
        }
    }

    public function Get_State($division_id)
    {
        $get_state = State::where('division_id', $division_id)->orderBy('state_name', 'ASC')->get();

        return json_encode($get_state);
    }

    public function Get_Area($state_id)
    {
        $get_area = Area::where('state_id', $state_id)->orderBy('area_name', 'ASC')->get();

        return json_encode($get_area);
    }

    public function StoreCheckout(Request $request)
    {

        Session::put('details', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'division_id' => $request->division_id,
            'state_id' => $request->state_id,
            'area_id' => $request->area_id,
            'notes' => $request->notes,
        ]);

        $cartTotal = Cart::total();
// dd(session()->get('details'));
        if ($request->payment_method == 'paypal') {
        } elseif ($request->payment_method == 'card') {
        } elseif ($request->payment_method == 'paystack') {
            return view('frontend.pages.paystack', compact('cartTotal'));
        }
    }
}
