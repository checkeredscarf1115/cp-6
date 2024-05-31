@extends('layouts.app') @section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-header theme-color">{{ __("Вход") }}</div>

                <div class="card-body theme-color-light-gray">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label
                                for="phone_number"
                                class="col-md-4 col-form-label text-md-end"
                                >{{ __("Номер телефона") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    required
                                    autocomplete="phone_number"
                                    autofocus
                                />

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-end"
                                >{{ __("Пароль") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                />

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn theme-color">
                                    {{ __("Войти") }}
                                </button>

                                <a class="btn btn-secondary" href="/register">
                                    {{ __("Зарегистрироваться") }}
                                </a>

                                @if (Route::has('password.request'))
                                <a
                                    class="btn btn-link"
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __("Забыли пароль?") }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
