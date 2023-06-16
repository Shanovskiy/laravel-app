@extends('admin.admin-page')

@section('title', 'Редактировние Машины')
@section('content')
    <form action="" method="POST">
        @csrf
        <input name="id" type="hidden" value="{{$id}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="brand" class="form-label">Brand</label>
            </div>
            <div class="col-auto">
                <input name="brand" type="text" class="form-control" id="brand" value="{{$car["brand"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="model" class="form-label">Model</label>
            </div>
            <div class="col-auto">
                <input name="model" type="text" class="form-control" id="model" value="{{$car["model"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="engine" class="form-label">Engine</label>
            </div>
            <div class="col-auto">
                <input name="engine" type="text" class="form-control" id="engine" value="{{$car["engine"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="year" class="form-label">Year</label>
            </div>
            <div class="col-auto">
                <input name="year" type="text" class="form-control" id="year" value="{{$car["year"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="color" class="form-label">Color</label>
            </div>
            <div class="col-auto">
                <input name="color" type="text" class="form-control" id="color" value="{{$car["color"]}}">
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="image_url" class="form-label">Ссылка на картинку</label>
            </div>
            <div class="col-auto">
                <input name="image_url" type="text" class="form-control" id="image_url" value="{{$car["image_url"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="description" class="form-label">Description</label>
            </div>
            <div class="col-auto">
                <input name="description" type="text" class="form-control" id="description" value="{{$car["description"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="price" class="form-label">Price</label>
            </div>
            <div class="col-auto">
                <input name="price" type="text" class="form-control" id="price" value="{{$car["price"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="discount" class="form-label">Discount</label>
            </div>
            <div class="col-auto">
                <input name="discount" type="text" class="form-control" id="discount" value="{{$car["discount"]}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
