<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RefundRequest;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends Controller
{
    public function userOrders()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $orders = Order::query()->where("user_id",$userId)->orderBy("created_at","desc")->get();
        return view("order.user-orders")->with("orders",$orders);
    }

    public function refundRequest()
    {
        $request = request()->post();
        $array =["order_id"=>$request["id"]];
        $refundRequest = new RefundRequest($array);
        $refundRequest->save();
        return redirect()->route('user-orders');
    }
}
