@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <h1>
                    Введите контактные данные:
                </h1>
            </div>
        </div>

        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <form action="/clients" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="secondname" name="secondname" placeholder="Иванов" value="{{ old('secondname') }}">
                        <label for="secondname">Фамилия</label>
                        <small class="text-danger">
                            @error('secondname')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Иван" value="{{ old('firstname') }}">
                        <label for="firstname">Имя</label>
                        <small class="text-danger">
                            @error('firstname')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="patronymic" name="patronymic" placeholder="Иванович" value="{{ old('patronymic') }}">
                        <label for="patronymic">Отчество</label>
                        <small class="text-danger">
                            @error('patronymic')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Email</label>
                        <small class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+79643336437" pattern="^+7[0-9]{10}$" value="{{ old('phone') }}">
                        <label for="phone">Телефон</label>
                        <small class="text-secondary">Формат: +79643336437</small>
                        <br>
                        <small class="text-danger">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" type="submit">
                            Подать заявку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection