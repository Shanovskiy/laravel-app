    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    @yield("styles")
    @yield("headScripts")
</head>
<body>
<nav class="navbar" style="background-color: #e3f2fd;">
    <!-- Navbar content -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route("root")}}">АвтоСалон</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("add-car")}}">Добавить машину</a>
                    </li>
                    <li class="nav-item">
                        @if( !Auth::user())
                        <a class="nav-link" href="{{route("login")}}">Войти</a>
                        @endif
                            @if( Auth::user())
                        <li>
                            <img src="{{Auth::user()->image}}">
                        </li>
                        <li>
                            <a class="nav-link" href="{{route("edit-profile")}}">Профиль</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route("user-orders")}}">Мои заказы</a>
                        </li>
                        <li>
                            <a class="nav-link" href='{{route("favorites")}}'>Избранное</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route("balance")}}">Мой Счёт</a>
                        </li>
                        <li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Выйти</button>
                            </form>
                        </li>
                    @endif
                </ul>
                    </li>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</nav>
@yield("content")
@yield("scripts")
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>
</html>
