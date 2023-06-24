<?php

namespace App\Http\Controllers;

use App\Models\AuctionCar;
use App\Models\AuctionOrder;
use App\Models\Car;
use App\Models\Order;
use App\Models\User;

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
        $auctionCar = new AuctionCar($request);
        $auctionCar->save();
        return redirect()->route('admin.page');
    }
    public function viewAuction()
    {
        $auctionCars = AuctionCar::query()->get();
        $cars = Car::query()->get();
        return view("admin.view-auction")->with("auctionCars",$auctionCars)->with("cars",$cars);
    }

    public function endAuction()
    {
        $request =request()->post();
        $auctionCar = AuctionCar::query()->find($request["id"]);
        $data =["car_id"=>$auctionCar->car_id,"user_id"=>$auctionCar->user_id,"price"=>$auctionCar->auction_price];
        $order = new AuctionOrder($data);
        $order->save();
        AuctionCar::query()->where("id",$request["id"])->update(["completed"=>"yes"]);
        return redirect()->route("view-auction");
    }
}
