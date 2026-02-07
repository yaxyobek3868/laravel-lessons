<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O`quv markaz</title>
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="{{ route('courses.index') }}" @class(['nav-link', 'active' => request()->routeIs('courses.index')])>Kurslar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('groups.index') }}" @class(['nav-link', 'active' => request()->routeIs('groups.index')])>Gruhlar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" @class(['nav-link', 'active' => request()->routeIs('users.index')])>O'qituvchilar va O'quvchilar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lessons.index') }}" @class(['nav-link', 'active' => request()->routeIs('lessons.index')])>Darslar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profiles.index') }}" @class(['nav-link', 'active' => request()->routeIs('profiles.index')])>Profil</a>
                </li>
            </ul>

        </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>


    <script src="{{ asset("assets/js/bootstrap.bundle.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
</body>
</html>
