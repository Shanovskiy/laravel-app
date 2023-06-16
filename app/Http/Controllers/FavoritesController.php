<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function viewFavorites()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $favorites = Favorite::query()->where("user_id",$userId)->get();
        $cars = Car::query()->get();
        return view("profile.favorites")->with("cars",$cars)->with("favorites",$favorites);
    }

    public function saveNewFavorite()
    {
        $request = request()->post();
        $user_id =Auth::user()->getAuthIdentifier();
        $data = ['car_id'=>$request['car_id'],'user_id'=>$user_id];
        $favorite = new Favorite($data);
        $favorite->save();
        return redirect()->route("root");
    }

    public function deleteFavorite()
    {
        $request = request()->post();
        $userId = Auth::user()->getAuthIdentifier();
        Favorite::query()->where("user_id",$userId)->where("car_id",$request["car_id"])->delete();
        return redirect()->route("favorites");
    }
}
