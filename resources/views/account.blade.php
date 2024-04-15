@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Учётная запись') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" name="name">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Фамилия') }}</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" name="surname">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Адрес электронной почты') }}</label>

                        <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" name="email">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Старый пароль') }}</label>

                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control" name="old_password">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Новый пароль') }}</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Подтверждение нового пароля') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="col">
                            <a href="{{ route('account') }}" class="btn btn-primary">Изменить</a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection