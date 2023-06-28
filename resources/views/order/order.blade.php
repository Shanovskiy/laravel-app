@extends('layouts.app')

@section('title', 'Заказ')

@section('content')
    <h1>Заказ</h1>
    <img src ="{{$car->image_url}}" width="400px" height="275x" alt="...">
    <h5 class="card-title">{{$car->brand}}</h5>
    <h5 class="card-title">{{$car->model}}</h5>
    <h5 class="card-title">{{$car->getPriceWithDiscount()}}</h5>
    <form action="{{route("saveOrder")}}" method="post">
        @csrf
        <input type ="hidden" name="car_id" value="{{$car->id}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="promocode" class="form-label">PromoCode</label>
            </div>
            <div class="col-auto">
                <input name="promocode" type="text" class="form-control" id="promocode">
            </div>
        </div>
        <button type="submit" id="submit-button" class="btn btn-primary" >Сохранить</button>
    </form>
@endsection

