@extends('layouts.app')

@section('title', 'Сброс пароля')
@section('content')
    <form method="POST" action="{{ route('change.password') }}">
        @csrf
        <input name="recovery_pin" type="hidden" value="{{$recovery_pin}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="col-auto">
                <input name="email" type="text" class="form-control" id="email" >
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input name="password" type="password" id="password" class="form-control" aria-labelledby="passwordHelpInline" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Изменить пароль</button>
    </form>
@endsection
