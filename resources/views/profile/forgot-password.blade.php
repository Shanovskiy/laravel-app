@extends('layouts.app')

@section('title', 'Сбросить пароль')
@section('content')

<form method="POST" action="{{ route("password.reset") }}">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="email" class="form-label">Email</label>
        </div>
        <div class="col-auto">
            <input name="email" type="text" class="form-control" id="email">
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Изменить пароль</button>
</form>
@endsection
