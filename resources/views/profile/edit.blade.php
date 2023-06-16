@extends('layouts.app')

@section('title', 'Изменить данные')
@section('content')
    <form action="{{route("add-user-image")}}" enctype="multipart/form-data" method="POST">
        @method("PUT")
        @csrf
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="image">Аватарка</label>
            <input name="image" type="file" class="form-control" id="image">
            <button type="submit" class="btn btn-primary">Изменить</button>
        </div>
    </div>
    </form>
    <form action="{{route("save-profile")}}" method="POST">
        @method("PUT")
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="name" class="form-label">Name</label>
            </div>
            <div class="col-auto">
                <input name="name" type="text" class="form-control" id="name" value="{{$user->name}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="col-auto">
                <input name="email" type="text" class="form-control" id="email" value="{{$user->email}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input name="password" type="password" id="password" class="form-control" aria-labelledby="passwordHelpInline" disabled >
            </div>
        </div>
        <button type="button"id="change-button" class="btn btn-primary">Изменить пароль</button>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset("js/profile/edit.js") }}"></script>
@endsection
