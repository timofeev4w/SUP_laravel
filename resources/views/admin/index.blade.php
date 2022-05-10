@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="d-flex justify-content-center">
                <h1>
                    Админка
                </h1>
            </div>
        </div>

        <div class="row pt-5 pb-5">
            @if (old('name'))
                <div class="d-flex justify-content-center pb-2">
                    <h3 class="text-success">
                        Менеджер - {{old('name')}} успешно создан!
                    </h3>
                </div>
            @endif


            <div class="d-flex justify-content-center">
                <a class="btn btn-success" href="{{ route('manager_registration') }}">Создать менеджера</a>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a class="btn btn-danger" href="{{ route('admin_logout') }}">Выход</a>
            </div>
        </div>
    </div>

@endsection