@extends('admin.admin-page')

@section('title', 'Возвраты')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Машина</th>
            <th scope="col">Цена</th>
            <th scope="col">Дата покупки</th>
            <th scope="col">Дата запроса возврата</th>
        </tr>
        </thead>
        <tbody>
        @foreach($refundRequests as $refundRequest)
            <tr>
                <form action="{{route("return-funds")}}" method="POST" name="form1">
                    @csrf
                <td>{{$refundRequest->order->user->email}}</td>
                <td>{{$refundRequest->order->car->brand}} {{$refundRequest->order->car->model}}</td>
                <td>{{$refundRequest->order->price}}</td>
                <td>{{$refundRequest->order->created_at}}</td>
                <td>{{$refundRequest->created_at}}</td>
                    <input name="id" type="hidden" value="{{$refundRequest->id}}">
                <td><button type="submit" class="btn btn-primary">Вернуть Средства</button></td>
            </form>
            <form action="{{route("return-refusal")}}" method="POST" name="form2">
                @csrf
                <input name="id" type="hidden" value="{{$refundRequest->id}}">
                <td><button type="submit" class="btn btn-primary">Отказать</button></td>
            </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
