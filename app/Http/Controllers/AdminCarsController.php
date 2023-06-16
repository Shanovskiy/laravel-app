<?php

namespace App\Http\Controllers;


use App\Models\Car;

class AdminCarsController extends Controller
{
    public function carsView()
    {
        $cars = Car::query()->get();
        return view("admin.cars")->with("cars",$cars);
    }
    public function carEdit()
    {
        $carId =request()->query()["id"];
        $car =Car::query()->find($carId)->toArray();
        return view("admin.cars-edit")->with("id",$carId)->with("car",$car);
    }

    public function carEditSave()
    {
        $request = request()->post();
        $car = Car::query()->find($request["id"]);

        $car->fill($request);

        $car->save();
        return redirect()->route("cars");
    }

    public function carDelete()
    {
        $request = request()->post();
        Car::query()->find($request["car_id"])->delete();
        return redirect()->route("cars");
    }
}
