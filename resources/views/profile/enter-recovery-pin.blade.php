@extends('layouts.app')

@section('title', 'Сброс пароля')
@section('content')
    @csrf
    <form method="POST" action="{{ route("recovery.pin") }}">
        @csrf
        <input name="email" type="hidden" value="{{$email}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="recovery_pin" class="form-label">Код</label>
            </div>
            <div class="col-auto">
                <input name="recovery_pin" type="text" class="form-control" id="recovery_pin">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ввести код</button>
    </form>
@endsection
