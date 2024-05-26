@extends('layouts.app')

@section('menu')
        <nav class="navbar navbar-expand-md navbar-light theme-color-gray shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Вход') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="pt-5">
            <div class="container">
                <div class="row justify-content-left">
                    @if(Request::url() === url('/reserve'))
                        <div class="col-2 text-center theme-color border border-secondary px-3 py-2">
                    @else
                        <div class="col-2 text-center theme-color-dark-gray border border-secondary px-3 py-2">
                    @endif
                        <a href="{{ url('/reserve') }}" class="text-decoration-none text-reset">Бронирование мест</a>
                    </div>

                    @if(Request::url() === url('/reservations'))
                        <div class="col-2 text-center theme-color border border-secondary px-3 py-2">
                    @else
                        <div class="col-2 text-center theme-color-dark-gray border border-secondary px-3 py-2">
                    @endif
                        <a href="{{ url('/reservations') }}" class="text-decoration-none text-reset">Действующие брони</a>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('content')
            <div class="container theme-color-light-gray py-4 px-4">

                        @yield('inside-content')

            </div>
@endsection
