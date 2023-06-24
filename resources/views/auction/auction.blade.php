@extends('layouts.app')

@section('title', 'Аукцион')
@section('content')
    <div style="display: flex; flex-direction: row; flex-wrap: wrap;" xmlns="http://www.w3.org/1999/html">
        @foreach($cars as $car)
            @foreach($auctionCars as $auctionCar)
                @if($auctionCar->car_id==$car->id)
                    @if($auctionCar->completed!="yes")
                    <form action="{{route("new-bet")}}" method="POST">
                        @method("PUT")
                        @csrf
                        <input name="id" type="hidden" value="{{$auctionCar->id}}">
                        <div class="card" style="width: 18rem;">
                        <img src="{{$car->image_url}}" class="card-img-top" style="width: 300px;height: 225px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$car->brand}}</h5>
                            <p class="card-text">{{$car->model}}</p>
                            <p class="card-text">Объем двигателя:{{$car->engine}}</p>
                            <p class="card-text">Год:{{$car->year}}</p>
                            <p class="card-text">Цвет: {{$car->color}}</p>
                            <p class="card-text">{{$car->description}}</p>
                            <p class="card-text">Текущая стоимость {{$auctionCar->auction_price}} руб.</p>
                            <p class="card-text">Минимальный шаг {{$auctionCar->minimum_step}} руб.</p>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="auction_price" class="form-label">Введите ставку</label>
                                </div>
                                <div class="col-auto">
                                    <input name="auction_price" type="text" class="form-control" id="auction_price" value="{{$auctionCar->auction_price+$auctionCar->minimum_step}}">
                                </div>
                            </div>
                            <td><button type="submit" class="btn btn-primary">Сделать ставку</button></td>
                        </div>
                    </div>
                    </form>
                @endif
                @endif
            @endforeach
        @endforeach
    </div>
@endsection
