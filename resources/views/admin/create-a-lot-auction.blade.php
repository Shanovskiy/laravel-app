@extends('admin.admin-page')

@section('title', 'Создать лот')
@section('content')
    <div style="display: flex; flex-direction: row; flex-wrap: wrap;" xmlns="http://www.w3.org/1999/html">
            <form action="{{route("putUpForAuction")}}" method="POST">
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
                        <button class="btn btn-primary">Выставить на аукцион</button>
                    </div>
                </div>
            </form>
    </div>
@endsection
