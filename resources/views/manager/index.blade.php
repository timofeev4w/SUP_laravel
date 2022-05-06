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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Email</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Дата заявки</th>
                        <th scope="col">Дата редактирования</th>
                    </tr>
                </thead>
                @forelse ($clients as $client)
                    <tr class="table-row" id="{{ $client->id }}">
                        <th scope="row">{{ $client->id }}</th>
                        <td>{{ $client->secondname.' '.$client->firstname.' '.$client->patronymic  }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
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

    <script src="/js/manager_index.js"></script>
@endsection