<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class OrderFeedController extends Controller
{
    public function orderFeedView()
    {
        $orders = Order::query()->orderBy("created_at","desc")->get();
        return view("admin.order-feed")->with("orders",$orders);
    }

}
