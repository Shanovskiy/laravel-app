<?php

namespace App\Http\Controllers;

use App\Events\OrderCarEvent;
use App\Models\Order;
use App\Models\Car;
use App\Models\Promocode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function orderCar($id)
    {
        $user = Auth::user();
        $car = Car::query()->find($id);
        return view("order.order")->with("car", $car)->with("user", $user);
    }

    private function promoCodeNotNull($user,$car,$price,$balance,$carId,$userId){
        $promocode = Promocode::query()->where("name", request()->post("promocode"))->first();
        if ($promocode == null) {
            return response("Промокода не существует", 401);
        } else{
            if (strtotime($promocode->date) >= time()) {
                if ($user->discount + $car->discount + $promocode->discount < 100) {
                    $priceWithDiscount = $price - ($price * ($user->discount + $car->discount + $promocode->discount) / 100);
                } else {
                    $priceWithDiscount = $price - ($price * 99 / 100);
                }
                if ($balance > $priceWithDiscount) {
                    $this->newOrder($balance, $priceWithDiscount, $userId, $carId);
                }
            }
            else{
                return response("Вышел срок действия промокода", 401);
            }
            return redirect()->route('root');
        }
    }
    private function newOrder($balance,$priceWithDiscount,$userId,$carId){
        $array = ["car_id" => $carId, "user_id" => $userId, "price" => $priceWithDiscount];
        $order = new Order($array);
        $order->save();
        $newBalance = $balance - $priceWithDiscount;

        User::query()->where("id", $userId)->update(["balance" => $newBalance]);
        event(new OrderCarEvent($order));
        return redirect()->route('root');
    }
    public function saveOrderCar()
    {
        $carId = request()->post('car_id');
        $userId = Auth::user()->getAuthIdentifier();
        $user = User::query()->find($userId);
        $balance = User::query()->find($userId)->balance;
        $car = Car::query()->find($carId);
        $price = Car::query()->find($carId)->price;
        $promoCode = request()->post("promocode");
        if ($promoCode != null) {
            return $this->promoCodeNotNull($user, $car, $price, $balance, $carId, $userId);
        } else {
            if ($user->discount + $car->discount < 100) {
                $priceWithDiscount = $price - ($price * ($user->discount + $car->discount) / 100);
            } else {
                $priceWithDiscount = $price - ($price * 99 / 100);
            }
            if ($balance > $priceWithDiscount) {
                return $this->newOrder($balance, $priceWithDiscount, $userId, $carId);
            } else {
                return redirect()->route('insufficient-funds');
            }
        }
    }
}
