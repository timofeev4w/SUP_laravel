@extends('layouts.app')

@section('js-head')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row pt-3 pb-5">
            <div class="d-flex justify-content-start">
                <a href="{{ session('manager_filter_url') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    Вернуться к списку
                </a>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center">
                <h4>Выберите даты:</h4>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center">
                <form action="" id="filter">
                    <div class="col-12 pt-2 d-flex justify-content-center">
                        <label for="start" class="pe-1">C:</label>
                        <input class="me-2 date" type="date" id="start" name="date-start"
                            value="{{ empty($_GET['date-start']) ? $date_start : $_GET['date-start'] }}"
                            min="{{ $date_start }}" max="{{ $date_end }}">

                        <label class="pe-1" for="end">По:</label>
                        <input class="date" type="date" id="end" name="date-end"
                            value="{{ empty($_GET['date-end']) ? $date_end : $_GET['date-end'] }}"
                            min="{{ $date_start }}" max="{{ $date_end }}">
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center p-3">
                            <a href="{{ route('report') }}?date-start={{ date('Y-m-d', (time() - 60*60*24*30)) }}&date-end={{ date('Y-m-d', time()) }}" class="btn btn-warning btn-sm">Сброс</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center" id="clients" style="width: 1300px">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        let days = Object.entries({{ Illuminate\Support\Js::from($days) }});
    </script>

    <script src="/js/report.js"></script>
@endsection