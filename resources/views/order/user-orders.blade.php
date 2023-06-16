@extends('layouts.app')

@section('title', 'Мои заказы')
@section('content')
    <button class="btn btn-primary" id="download-button">Скачать отчет</button>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Машина</th>
            <th scope="col">Цена</th>
            <th scope="col">Дата покупки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <form action="" method="POST">
                @csrf
            <tr>
                <td>{{$order->car->brand}} {{$order->car->model}}</td>
                <td>{{$order->car->getPriceWithDiscount()}} руб.</td>
                <td>{{$order->created_at}}</td>
                <input name="id" type="hidden" value="{{$order->id}}">
                <td><button type="submit" class="btn btn-primary">Запросить возврат средств</button></td>
            </tr>
            </form>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    <script src="{{ asset("js/orders/users-orders.js") }}"></script>
@endsection
