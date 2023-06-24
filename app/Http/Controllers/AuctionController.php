<?php

namespace App\Http\Controllers;


use App\Events\BetOutEvent;
use App\Models\AuctionCar;
use App\Models\AuctionOrder;
use App\Models\Car;
use App\Models\HistoryBet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    public function auctionView()
    {
        $auctionCars = AuctionCar::query()->get();
        $cars = Car::query()->get();
        return view("auction.auction")->with("auctionCars",$auctionCars)->with("cars",$cars);
    }

    public function newBet()
    {
        $request = request()->post();
        $userId = Auth::user()->getAuthIdentifier();
        $auctionCar = AuctionCar::query()->find($request["id"]);
        $user =User::query()->find($userId);
        if($user->balance>$auctionCar->auction_price){
            if($auctionCar->user_id!=null){
                $oldUser = User::query()->find($auctionCar->user_id);
                event(new BetOutEvent($auctionCar));
                $dataOldUser = ["balance"=>($oldUser->balance + $auctionCar->auction_price)];
                $oldUser->fill($dataOldUser);
                $oldUser->save();
                $historyReturn = new HistoryBet(["user_id"=>$auctionCar->user_id,"auction_car_id"=>$auctionCar->id,"return"=>$auctionCar->auction_price]);
                $historyReturn->save();
            }
            $dataUser = ["balance"=>($user->balance -$request["auction_price"])];
            $user->fill($dataUser);
            $user->save();
            $data =["auction_price"=>$request["auction_price"],"user_id"=>$userId];
            $auctionCar->fill($data);
            $auctionCar->save();
            $historyBet = new HistoryBet(["user_id"=>$userId,"auction_car_id"=>$auctionCar->id,"bet"=>$request["auction_price"]]);
            $historyBet->save();
            return redirect()->route("auction");
        }
        return redirect()->route('insufficient-funds');
    }

    public function userAuctionOrdersView()
    {
        $auctionOrders = AuctionOrder::query()->get();
        return view("auction.users-auction-orders")->with("auctionOrders",$auctionOrders);
    }
}
