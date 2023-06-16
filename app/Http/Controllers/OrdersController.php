<?php

namespace App\Http\Controllers;
use App\Events\OrderCarEvent;
use App\Models\Order;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function orderCar($id)
    {
        $user = Auth::user();
        $car =Car::query()->find($id);
        return view("order.order")->with("car",$car)->with("user",$user);
    }

    public function saveOrderCar()
    {
        $carId = request()->post('car_id');
        $userId = Auth::user()->getAuthIdentifier();
        $balance =User::query()->find($userId)->balance;
        $priceWithDiscount =Car::query()->find($carId)->getPriceWithDiscount();
        if($balance>$priceWithDiscount){
            $array =["car_id"=>$carId,"user_id"=>$userId,"price"=>$priceWithDiscount];
            $order = new Order($array);
            $order->save();
            $newBalance = $balance -$priceWithDiscount;

            User::query()->where("id",$userId)->update(["balance" => $newBalance]);
            event(new OrderCarEvent($order));
            return redirect()->route('root');
        }
        return redirect()->route('insufficient-funds');
    }


}
