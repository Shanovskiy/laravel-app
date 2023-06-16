@extends('admin.admin-page')

@section('title', 'Аукцион')
@section('content')
    <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
    @foreach($cars as $car)
            <form action="" method="POST">
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
                    <a href="{{route("create-a-lot", ['id' => $car->id])}}" class="btn btn-primary">Создать лот</a>
            </div>
        </div>
        </form>
    @endforeach
    </div>
@endsection
