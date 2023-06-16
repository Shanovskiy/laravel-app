@extends('layouts.app')

@section('title', 'Добавить машину')
@section('content')
    <form action="{{route("add-new-car")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="brand" class="form-label">Марка</label>
            <input name="brand" type="text" class="form-control" id="brand">
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Модель</label>
            <input name="model" type="text" class="form-control" id="model">
        </div>
        <div class="mb-3">
            <label for="engine" class="form-label">Объем двигателя</label>
            <input name="engine" type="text" class="form-control" id="engine">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Год</label>
            <input name="year" type="text" class="form-control" id="year">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Цвет</label>
            <input name="color" type="text" class="form-control" id="color">
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="image">Картинка</label>
                <input name="image" type="file" class="form-control" id="image">
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <input name="description" type="text" class="form-control" id="description">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input name="price" type="text" class="form-control" id="price">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
