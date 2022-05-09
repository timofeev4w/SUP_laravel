@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/manager_index.css" type="text/css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row pt-3 pb-5">
            <div class="d-flex justify-content-end">
                <h3>Привет, {{ Auth::guard('manager')->user()->name }}!</h3>
                <div class="ps-2">
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Выход</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-center">
                <h4>Сортировка по:</h4>
            </div>

            <div class="d-flex justify-content-center">
                <form action="" id="filter">
                    <div class="row">
                        <div class="d-flex justify-content-center p-3">
                            <input class="form-control" list="datalistOptions" id="city" name="city" placeholder="Выберите город..." value="{{ (empty($_GET['city']) ? '' : $_GET['city']) }}">
                            <datalist id="datalistOptions">
                                @forelse ($cities as $city)
                                    <option value="{{ $city->name }}">
                                @empty
                                    
                                @endforelse
                            </datalist>
                        </div>
                    </div>

                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="sortby" id="created_at" autocomplete="off" value="created_at" {{ empty($_GET['sortby']) ? 'checked' : ($_GET['sortby'] == 'created_at' ? 'checked' : '') }}>
                        <label class="btn btn-outline-primary" for="created_at">дате заявки</label>
                    
                        <input type="radio" class="btn-check" name="sortby" id="updated_at" autocomplete="off" value="updated_at" {{ empty($_GET['sortby']) ? '' : ($_GET['sortby'] == 'updated_at' ? 'checked' : '') }}>
                        <label class="btn btn-outline-primary" for="updated_at">дате редактирования</label>
                    </div>

                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="sortmethod" id="desc" autocomplete="off" value="desc" {{ empty($_GET['sortmethod']) ? 'checked' : ($_GET['sortmethod'] == 'desc' ? 'checked' : '') }}>
                        <label class="btn btn-outline-primary" for="desc">сначала недавние</label>
                    
                        <input type="radio" class="btn-check" name="sortmethod" id="asc" autocomplete="off" value="asc" {{ empty($_GET['sortmethod']) ? '' : ($_GET['sortmethod'] == 'asc' ? 'checked' : '') }}>
                        <label class="btn btn-outline-primary" for="asc">сначала давние</label>
                    </div>

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
                            <a href="/manager" class="btn btn-warning btn-sm">Сброс</a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ФИО</th>
                        <th scope="col">Email</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Адрес</th>
                        <th scope="col">Дата заявки</th>
                        <th scope="col">Дата редактирования</th>
                    </tr>
                </thead>
                @forelse ($clients as $client)
                    <tr class="table-row" id="{{ $client->id }}">
                        <td>{{ $client->secondname.' '.$client->firstname.' '.$client->patronymic  }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ ($client->city_id != NULL ? $client->city->name : '').($client->city_id != NULL ? ', ' : '').$client->address }}</td>
                        <td>{{ $client->created_at->format('d-m-Y h:m:s') }}</td>
                        <td>{{ $client->updated_at->format('d-m-Y h:m:s') }}</td>
                    </tr>
                @empty
                    
                @endforelse
                    
                <tbody>

                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $clients->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $clients->previousPageUrl() }}">Previous</a>
                </li>

                <li class="page-item {{ $clients->currentPage() == 1 ? 'active' : '' }}"> 
                    <a class="page-link" 
                    href="{{ $clients->url(1) }}">1</a>
                </li>

                {{-- @forelse ($clients as $key => $client) --}}
                @for ($page = 2; $page <= ($clients->lastPage() - 1); $page++)
                    {{-- @php
                        $dot_counter = 0;
                    @endphp --}}

                    @if ($page < $clients->currentPage() + 5 && $page > $clients->currentPage() - 5)
                        <li class="page-item {{ $clients->currentPage() == $page ? 'active' : '' }}"> 
                            <a class="page-link" 
                            href="{{ $clients->url($page) }}">{{ $page }}</a>
                        </li>
                    {{-- @elseif($page == floor($clients->lastPage() / 2))
                        <li class="page-item {{ $clients->currentPage() == $page ? 'active' : '' }}"> 
                            <a class="page-link" 
                            href="{{ $clients->url($page) }}">...</a>
                        </li> --}}
                    @endif
                @endfor

                @if ($clients->lastPage() != 1)
                    <li class="page-item {{ $clients->currentPage() == $clients->lastPage() ? 'active' : '' }}"> 
                        <a class="page-link" 
                        href="{{ $clients->url($clients->lastPage()) }}">{{ $clients->lastPage() }}</a>
                    </li>
                @endif
                
                <li class="page-item {{ $clients->currentPage() == $clients->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link"  href="{{ $clients->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        let current_page = {{ $clients->currentPage() }};
    </script>

    <script src="/js/manager_index.js"></script>
@endsection