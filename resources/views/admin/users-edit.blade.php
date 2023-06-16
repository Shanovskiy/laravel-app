@extends('admin.admin-page')

@section('title', 'Изменить Данные')
@section('content')
    <form action="" method="POST">
        @method("PUT")
        @csrf
        <input name="id" type="hidden" value="{{$id}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="name" class="form-label">Name</label>
            </div>
            <div class="col-auto">
                <input name="name" type="text" class="form-control" id="name" value="{{$user["name"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="col-auto">
                <input name="email" type="text" class="form-control" id="email" value="{{$user["email"]}}">
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="balance" class="form-label">Balance</label>
            </div>
            <div class="col-auto">
                <input name="balance" type="text" class="form-control" id="balance" value="{{$user["balance"]}}">
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
    <form action="{{route("user.edit.role.save")}}" method="POST">
        @method("PUT")
        @csrf
        <input name="id" type="hidden" value="{{$user["id"]}}">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="role_name" class="col-form-label">Текущая роль: {{$roleName}}</label>
            </div>
        </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="role_id" class="form-label">Выбрать роль</label>
        </div>
        <div class="col-auto">
            <select name="role_id" class="form-control" id="role_id">
                <option value=1>Admin</option>
                <option value=2>User</option>
                <option value=3>Banned</option>
            </select>
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Изменить Роль</button>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset("js/profile/edit.js") }}"></script>
@endsection
