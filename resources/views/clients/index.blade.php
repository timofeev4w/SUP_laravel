@extends('layouts.app')

@section('content')
    <div class="container">
        @if(old('firstname') != null)
            <div class="row pt-5 pb-2">
                <div class="d-flex justify-content-center">
                    <h3 class="text-success">
                        {{ old('firstname') }}, cпасибо за заявку! Мы с Вами свяжемся :)
                    </h3>
                </div>
            </div>
        @endif

        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <h1>
                    Выберите роль:
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-center">
                    <a href="/clients/create" class="btn btn-success btn-lg">Я клиент!</a>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-center">
                    <a href="/clients/showall" class="btn btn-primary btn-lg">Я менеджер!</a>
                </div>
            </div>
        </div>
    </div>
@endsection