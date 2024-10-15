<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/nav-style.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Sistem Voting Online') }}</title>
</head>
<body>
    <div>
        <nav class="nav-container">
            <nav class="navbar">
                <h1 id="navbar-logo">POLLSAFE</h1>
                <div class="menu-toggle" id="mobile-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="/" class="nav-links">Home</a></li>
                    <li><a href="/about-us" class="nav-links">About Us</a></li>
                    <li><a href="/organizations" class="nav-links">Organization</a></li>
                    <li><a href="/faq" class="nav-links">FAQ</a></li>
                    @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </li>
                    @endguest

                </ul>
            </nav>
        </nav>
    </div>
    <script type="text/javascript" src="{{ asset('js/nav-script.js') }}"></script>
</body>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>