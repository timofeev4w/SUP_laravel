@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-3 pb-5">
            <div class="d-flex justify-content-start">
                <a href="{{ route('manager') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                      </svg>
                    Вернуться к списку
                </a>
            </div>
        </div>

        <div class="row pb-5">
            <div class="d-flex justify-content-center">
                <h1>
                    Введите новые данные:
                </h1>
            </div>
        </div>

        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <form action="/manager/client/{{ $client->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="secondname" name="secondname" placeholder="Иванов" value="{{ empty(old('secondname')) ? $client->secondname : old('secondname') }}">
                        <label for="secondname">Фамилия</label>
                        <small class="text-danger">
                            @error('secondname')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Иван" value="{{ empty(old('firstname')) ? $client->firstname : old('firstname') }}">
                        <label for="firstname">Имя</label>
                        <small class="text-danger">
                            @error('firstname')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="patronymic" name="patronymic" placeholder="Иванович" value="{{ empty(old('patronymic')) ? $client->patronymic : old('patronymic') }}">
                        <label for="patronymic">Отчество</label>
                        <small class="text-danger">
                            @error('patronymic')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="city" name="city" placeholder="Санкт-Петербург" value="{{ empty(old('city')) ? $client->city->name : old('city') }}">
                        <label for="city">Город</label>
                        <small class="text-danger">
                            @error('city')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Нижняя Красносельская, 43, кв. 1" value="{{ empty(old('address')) ? $client->address : old('address') }}">
                        <label for="address">Адрес</label>
                        <small class="text-danger">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ empty(old('email')) ? $client->email : old('email') }}">
                        <label for="email">Email</label>
                        <small class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+79643336437" pattern="^+7[0-9]{10}$" value="{{ empty(old('phone')) ? $client->phone : old('phone') }}">
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
                            Изменить данные
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection