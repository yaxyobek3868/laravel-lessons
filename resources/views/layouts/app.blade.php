<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O`quv markaz</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">    
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('homepages.index') }}" @class(['nav-link', 'active' => request()->routeIs('homepages.*')])>
                        {{ __('messages.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('courses.index') }}" @class(['nav-link', 'active' => request()->routeIs('courses.*')])>
                        {{ __('messages.courses') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('groups.index') }}" @class(['nav-link', 'active' => request()->routeIs('groups.*')])>
                        {{ __('messages.groups') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" @class(['nav-link', 'active' => request()->routeIs('users.*')])>
                        {{ __('messages.teachers_students') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lessons.index') }}" @class(['nav-link', 'active' => request()->routeIs('lessons.*')])>
                        {{ __('messages.lessons') }}
                    </a>    <li>
                        <a class="dropdown-item" href="{{ route('lang.switch', 'uz') }}">UZ</a>
                        </li>
                </li>
            </ul>

                 <ul class="navbar-nav ms-auto mb-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                       <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item {{ App::getLocale() == 'en' ? 'active' : '' }}" 
                                href="{{ route('lang.switch', 'en') }}">EN</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ App::getLocale() == 'uz' ? 'active' : '' }}" 
                                href="{{ route('lang.switch', 'uz') }}">UZ</a>
                            </li>
                        </ul>
                     </li>

                @auth
                    <li class="nav-item">
                        <a href="{{ route('profiles.index') }}" @class(['nav-link', 'active' => request()->routeIs('profiles.index')])>
                            {{ __('messages.profile') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    @yield('content')
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
