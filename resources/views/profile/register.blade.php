@extends('layouts.app')

@section('title', 'Регистрация')
@section("headScripts")
    {!! htmlScriptTagJsApi(config("recaptcha")) !!}
@endsection
@section('content')
    <form action="" method="post">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="name" class="form-label">Name</label>
            </div>
            <div class="col-auto">
                <input name="name" type="text" class="form-control" id="name">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="col-auto">
                <input name="email" type="text" class="form-control" id="email">
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
        <button type="submit" class="btn btn-primary">Регистрация</button>
        {!! htmlFormSnippet() !!}
    </form>
@endsection
