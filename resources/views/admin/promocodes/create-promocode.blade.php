@extends('admin.admin-page')

@section('title', 'Промокод')
@section('content')
    <form action="{{route("create-promocode")}}" method="POST">
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
                <label for="discount" class="form-label">Discount</label>
            </div>
            <div class="col-auto">
                <input name="discount" type="text" class="form-control" id="discount">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="date" class="form-label">Date</label>
            </div>
            <div class="col-auto">
                <input name="date" type="date" class="form-control" id="date">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
