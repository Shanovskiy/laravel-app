@extends('admin.admin-page')

@section('title', 'Машины')
@section('content')
    <a href="{{route("add-car")}}" class="btn btn-primary" >Добавить машину</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Машина</th>
            <th scope="col">Двигатель</th>
            <th scope="col">Год</th>
            <th scope="col">Цвет</th>
            <th scope="col">Цена</th>
            <th scope="col">Скидка</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                @csrf
                <td>{{$car->brand}} {{$car->model}}</td>
                <td>{{$car->engine}}</td>
                <td>{{$car->year}}</td>
                <td>{{$car->color}}</td>
                <td>{{$car->price}}</td>
                <td>{{$car->discount}}%</td>
                <td><a href="{{route("car.edit",["id"=>$car->id])}}" class="btn btn-primary">Изменить</a></td>
                <td><form action="" method="post">
                    @csrf
                    <input type ="hidden" name="car_id" value="{{$car->id}}">
                    <button type="submit" id="submit-button" class="btn btn-primary" >Удалить</button>
                </form></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
