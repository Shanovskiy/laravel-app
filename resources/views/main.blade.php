@extends('layouts.app')

@section('title', 'Главная Страница')
@section('content')
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Brands
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route("root")}}">Все бренды</a></li>
            @foreach($brands as $brand)
            <li><a class="dropdown-item" href="{{route("root")."?brand=".$brand}}">{{$brand}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Models
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route("root")}}">Все модели</a></li>
            @foreach($models as $model)
                <li><a class="dropdown-item" href="{{route("root")."?model=".$model}}">{{$model}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Price
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route("root")."?price_up="."up"}}">Price up</a></li>
            <li><a class="dropdown-item" href="{{route("root")."?price_down="."down"}}">Price down</a></li>
        </ul>
    </div>



    <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
    @foreach($cars as $car)
            <form action="{{route("save-new-favorite")}}" method="POST">
                @csrf
                <input name="car_id" type="hidden" value="{{$car->id}}">
        <div class="card" style="width: 18rem;">
            <img src="{{$car->image_url}}" class="card-img-top" style="width: 300px;height: 225px;" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$car->brand}}</h5>
                <p class="card-text">{{$car->model}}</p>
                <p class="card-text">Объем двигателя:{{$car->engine}}</p>
                <p class="card-text">Год:{{$car->year}}</p>
                <p class="card-text">Цвет: {{$car->color}}</p>
                <p class="card-text">{{$car->description}}</p>
                @if($car->discount==0)
                <p class="card-text">{{$car->price}} руб.</p>
                @endif
                @if($car->discount!=0)
                    <p class="card-text">Начальная цена {{$car->price}}</p>
                    <p class="card-text">Скидка {{$car->discount}}%</p>
                    <p class="card-text">Итого {{$car->price-($car->price*$car->discount/100)}} руб.</p>
                @endif
                <a href="{{route("orderCar", ['id' => $car->id])}}" class="btn btn-primary">Заказать</a>
                @if(Auth::user())
                    @php
                        $isFavorite=false;
                        foreach ($favorites as $favorite){
                            if($favorite->car_id==$car->id){
                                $isFavorite=true;
                                break;
                            }
                        }
                        if(!$isFavorite){
                            echo '<td><button type="submit" class="btn btn-primary">Добавить в избранное</button></td>';
                        }
                    @endphp
                @endif
            </div>
    </div>
            </form>
        @endforeach
</div>
@endsection
