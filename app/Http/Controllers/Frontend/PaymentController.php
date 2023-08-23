<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Unicodeveloper\Paystack\Facades\Paystack;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    public function verify_product($reference)
    {
        $sec = "sk_test_c8da73ecc32dabadadb79ab107f850f1360e2fdd";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $sec",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $result = json_decode($response);
        $user_id = Auth::user()->id;

        if ($result->data->status === "success") {

            $total = (int)str_replace(',', '', Cart::total());
            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'];
            } else {
                $total_amount = round($total);
            }

            $order_id = Order::insertGetId([
                'user_id' => $user_id,
                'division_id' => Session::get('details')['division_id'],
                'state_id' => Session::get('details')['state_id'],
                'area_id' => Session::get('details')['area_id'],
                'name' => Session::get('details')['name'],
                'email' => Session::get('details')['email'],
                'phone' => Session::get('details')['phone'],
                'address' => Session::get('details')['address'],
                'post_code' => Session::get('details')['post_code'],
                'notes' => Session::get('details')['notes'],
                'payment_type' => 'PayStack',
                'payment_method' => $result->data->channel,
                'transaction_id' => $reference,
                'currency' => $result->data->currency,
                'amount' => $total_amount,
                'order_number' => $result->data->metadata->order_id,
                'invoice_no' => 'EOS'.mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d D'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now()
            ]);

            $carts = Cart::content();
            foreach ($carts as $values) {
                Order_Item::insert([
                    'order_id' => $order_id,
                    'product_id' => $values->id,
                    'color' => $values->options->color,
                    'size' => $values->options->size,
                    'qty' => $values->qty,
                    'price' => $values->price,
                    'created_at' => Carbon::now()
                ]);
            }

            session()->flush();
            Cart::destroy();

            return redirect()->route('home')->with('toast_success', 'Payment was Successful');
        } else {
            return redirect()->back()->with('toast_error', $result->message);
        }
    }
}

// {
//     "status": true,
//     "message": "Verification successful",
//     "data": {
//         "id": 3046628884,
//         "domain": "test",
//         "status": "success",
//         "reference": "T619743291444815",
//         "receipt_number": null,
//         "amount": 104000,
//         "message": "test-3ds",
//         "gateway_response": "[Test] Approved",
//         "paid_at": "2023-08-22T10:48:39.000Z",
//         "created_at": "2023-08-22T10:42:27.000Z",
//         "channel": "card",
//         "currency": "NGN",
//         "ip_address": "41.184.190.10",
//         "metadata": {
//             "referrer": "http://127.0.0.1:8000/checkout/store"
//         },
//         "log": {
//             "start_time": 1692700947,
//             "time_spent": 372,
//             "attempts": 2,
//             "authentication": "3DS",
//             "errors": 0,
//             "success": true,
//             "mobile": false,
//             "input": [],
//             "history": [
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: bank",
//                     "time": 158
//                 },
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: bank_transfer",
//                     "time": 161
//                 },
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: ussd",
//                     "time": 335
//                 },
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: bank_transfer",
//                     "time": 338
//                 },
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: bank",
//                     "time": 338
//                 },
//                 {
//                     "type": "input",
//                     "message": "Filled this field: account number",
//                     "time": 342
//                 },
//                 {
//                     "type": "action",
//                     "message": "Attempted to pay with bank account",
//                     "time": 342
//                 },
//                 {
//                     "type": "auth",
//                     "message": "Authentication Required: birthday",
//                     "time": 342
//                 },
//                 {
//                     "type": "auth",
//                     "message": "Authentication Required: registration_token",
//                     "time": 352
//                 },
//                 {
//                     "type": "auth",
//                     "message": "Authentication Required: payment_token",
//                     "time": 362
//                 },
//                 {
//                     "type": "action",
//                     "message": "Set payment method to: card",
//                     "time": 365
//                 },
//                 {
//                     "type": "action",
//                     "message": "Attempted to pay with card",
//                     "time": 369
//                 },
//                 {
//                     "type": "auth",
//                     "message": "Authentication Required: 3DS",
//                     "time": 370
//                 },
//                 {
//                     "type": "action",
//                     "message": "Third-party authentication window opened",
//                     "time": 371
//                 },
//                 {
//                     "type": "success",
//                     "message": "Successfully paid with card",
//                     "time": 372
//                 }
//             ]
//         },
//         "fees": 1560,
//         "fees_split": null,
//         "authorization": {
//             "authorization_code": "AUTH_2yd9xx80us",
//             "bin": "408408",
//             "last4": "0409",
//             "exp_month": "01",
//             "exp_year": "2030",
//             "channel": "card",
//             "card_type": "visa ",
//             "bank": "TEST BANK",
//             "country_code": "NG",
//             "brand": "visa",
//             "reusable": true,
//             "signature": "SIG_UAByPOkISsB0zbcJAP7B",
//             "account_name": null,
//             "receiver_bank_account_number": null,
//             "receiver_bank": null
//         },
//         "customer": {
//             "id": 106796072,
//             "first_name": "",
//             "last_name": "",
//             "email": "kebidegozi@gmail.com",
//             "customer_code": "CUS_yjtby4uc266j0cn",
//             "phone": "",
//             "metadata": null,
//             "risk_action": "default",
//             "international_format_phone": null
//         },
//         "plan": null,
//         "split": {},
//         "order_id": null,
//         "paidAt": "2023-08-22T10:48:39.000Z",
//         "createdAt": "2023-08-22T10:42:27.000Z",
//         "requested_amount": 104000,
//         "pos_transaction_data": null,
//         "source": null,
//         "fees_breakdown": null,
//         "transaction_date": "2023-08-22T10:42:27.000Z",
//         "plan_object": {},
//         "subaccount": {}
//     }
// }
                // 'confirmed_date' => $result->paidAt,
                // 'processing_date' => $result->createdAt,
                // 'picked_date' => $result->metadata->order_id,
                // 'shipped_date' => $result->metadata->order_id,
                // 'delivered_date' => $result->metadata->order_id,
                // 'cancel_date' => $result->metadata->order_id,
                // 'return_date' => $result->metadata->order_id,
                // 'return_reason' => $result->metadata->order_id,
