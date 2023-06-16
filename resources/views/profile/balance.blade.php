@extends('layouts.app')

@section('title', 'Счет')
@section('content')
    <h1>Счёт {{$user->balance}}руб.</h1>
@endsection
