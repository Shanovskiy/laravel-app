@extends('layouts.app')

@section('title', 'Мои заказы')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Машина</th>
            <th scope="col">Цена</th>
            <th scope="col">Дата покупки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auctionOrders as $auctionOrder)
                @csrf
                <tr>
                    <td>{{$auctionOrder->car->brand}} {{$auctionOrder->car->model}}</td>
                    <td>{{$auctionOrder->price}} руб.</td>
                    <td>{{$auctionOrder->created_at}}</td>
                </tr>
        @endforeach
        </tbody>
    </table>
@endsection
