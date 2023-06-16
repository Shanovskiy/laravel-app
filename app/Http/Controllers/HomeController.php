<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Favorite;
use App\ViewModels\CarViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function viewHome()
    {
        //получение машин
        $cars = Car::query()->get();
        //настройка фильтра брэнда
        $brands = Car::query()->select("brand")->distinct()->get()->toArray();
        $brands = array_map(function (array $item){
            return $item["brand"];
        },$brands);
        if(isset(request()->query()["brand"])){
            $cars = Car::query()->where("brand",request()->query()["brand"])->get();
        }
        //настройка фильтра модели
        $models = Car::query()->select("model")->distinct()->get()->toArray();
        $models = array_map(function (array $item){
            return $item["model"];
        },$models);
        if(isset(request()->query()["model"])){
            $cars = Car::query()->where("model",request()->query()["model"])->get();
        }
        //настройка сортировки по цене
        if(isset(request()->query()["price_up"])){
            $cars = Car::query()->orderBy("price","desc")->get();
        }
        if(isset(request()->query()["price_down"])){
            $cars = Car::query()->orderBy("price")->get();
        }
        if(Auth::user()){
            $userId = Auth::user()->getAuthIdentifier();
            $favorites =Favorite::query()->where("user_id",$userId)->get();
//            $this->carsAndFavoritesToCarViewModels($cars,$favorites);
            return view("main")->with("cars",$cars)->with("brands",$brands)->with("models",$models)->with("favorites",$favorites);
        }
        return view("main")->with("cars",$cars)->with("brands",$brands)->with("models",$models);
    }

//    /**
//     * @param Car[] $cars
//     * @param Favorite[] $favorites
//     * @return array
//     */
////    private function carsAndFavoritesToCarViewModels($cars,$favorites):array
////    {
////        $result =[];
////        foreach ($cars as $car){
////            $isFavorite=false;
////            foreach ($favorites as $favorite){
////                if($favorite->car_id==$car->id){
////                    $isFavorite=true;
////                    break;
////                }
////            }
////            $result[]= new CarViewModel($car->id,$car->brand,$car->model,$car->color,$car->engine,$car->year,$car->description,$car->image_url,$car->price,$car->discount,$isFavorite);
////
////        }
////        dd($result);
////    }

    public function addCar()
    {
        return view("add-car");
    }
    public function saveCar()
    {
        $request = request()->post();
        $image = request()->file("image");
        $filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
        Image::make($image->getRealPath())->resize(275, 500)->save(Storage::path('/public/image/cars/car').$filename,100);
        $image ='storage/image/cars/car'.$filename;
        $data = ["brand"=>$request["brand"],"model"=>$request["model"],"engine"=>$request["engine"],"year"=>$request["year"],"color"=>$request["color"],"description"=>$request["description"],"price"=>$request["price"],"image_url"=>$image];
        $car = new Car($data);
        $car->save();
        return redirect()->route('root');
    }
}
