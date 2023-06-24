@extends('admin.admin-page')

@section('title', 'Аукцион')
@section('content')
    <div style="display: flex; flex-direction: row; flex-wrap: wrap;" xmlns="http://www.w3.org/1999/html">
        @foreach($cars as $car)
            @foreach($auctionCars as $auctionCar)
                @if($auctionCar->car_id==$car->id)
                    @if($auctionCar->completed!="yes")
                    <form action="" method="POST">
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
                                @if($auctionCar->user_id!=null)
                                <p class="card-text">User Id {{$auctionCar->user_id}}</p>
                                @endif
                                <td><button type="submit" class="btn btn-primary">Закрыть лот</button></td>
                            </div>
                        </div>
                    </form>
                @endif
                @endif
            @endforeach
        @endforeach
    </div>
@endsection
