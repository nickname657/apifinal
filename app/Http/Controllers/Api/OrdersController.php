<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orderitems;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function store(Request $request)
    {

        if (session()->has('contador')) {
            session()->put('contador', session('contador') + 1);
        } else {
            session()->put('contador', 1);
        }

        $userid = 1;

        $order = new Orders();
        $order->user_id = $userid;
        $order->total_amount = $request->totalamount;
        $order->status = $request->status;
        $order->save();

        $cartItems = session('cart');
        foreach ($cartItems as $item) {
            $orderItem = new Orderitems();
            $orderItem->order_id = session('contador');
            $orderItem->product_id = $item['productId'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();
        }



        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ]);
    }


    public function filterorders(Request $request)
    {
        $iduser = $request->userid;
        $orders = DB::table('orders')
            ->select(['id', 'total_amount','status'])
            ->where('user_id', $iduser);

        return response()->json($orders);


    }
}
