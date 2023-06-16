@extends('admin.admin-page')

@section('title', 'Лента заказов')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Пользователь</th>
            <th scope="col">Машина</th>
            <th scope="col">Цена</th>
            <th scope="col">Дата покупки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            @csrf
            <input type ="hidden" name="car_id" value="{{$order->car_id}}">
            <td>{{$order->user->email}}</td>
            <td>{{$order->car->brand}} {{$order->car->model}}</td>
            <td>{{$order->price}}</td>
            <td>{{$order->created_at}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
