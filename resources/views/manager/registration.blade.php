@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <h1>
                    Регистрация
                </h1>
            </div>
        </div>

        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <form action="{{ route('registration') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Имя пользователя" value="{{ old('name') }}">
                        <label for="name">Имя пользователя</label>
                        <small class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Пароль" value="{{ old('password') }}">
                        <label for="password">Пароль</label>
                        <small class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" type="submit">
                            Регистрация
                        </button>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center pt-3">
                <a href="{{ route('login') }}">Есть аккаунт?</a>
            </div>
        </div>
    </div>

@endsection