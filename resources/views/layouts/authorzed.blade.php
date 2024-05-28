@extends('layouts.app')

@section('menu')
        <div class="pt-5">
            <div class="container">
                <div class="row justify-content-left">
                    @if(Request::url() === url('/reserve'))
                        <div class="col-2 text-center theme-color px-3 py-2">
                    @else
                        <div class="col-2 text-center theme-color-dark-gray px-3 py-2">
                    @endif
                        <a href="{{ url('/reserve') }}" class="text-decoration-none text-reset">Бронирование мест</a>
                    </div>

                    @if(Request::url() === url('/reservations'))
                        <div class="col-2 text-center theme-color px-3 py-2">
                    @else
                        <div class="col-2 text-center theme-color-dark-gray px-3 py-2">
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
