@extends('admin.admin-page')

@section('title', 'Пользователи')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Счёт</th>
            <th scope="col">Пароль</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @csrf
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->balance}}</td>
                <td><a href="{{route("user.edit",["id"=>$user->id])}}" class="btn btn-primary">Изменить</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
