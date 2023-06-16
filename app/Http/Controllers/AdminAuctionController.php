<?php

namespace App\Http\Controllers;

use App\Models\Car;

class AdminAuctionController extends Controller
{
    public function auctionView()
    {
        $cars = Car::query()->get();
        return view("admin.auction")->with("cars",$cars);
    }

    public function createALotAuction($id)
    {
        $car =Car::query()->find($id);
        return view("admin.create-a-lot-auction")->with("car",$car);
    }

    public function putUpForAuction()
    {
        $request = request()->post();
        dd($request);
    }
}
