@extends('layouts.app')

@section('content')
    <div class="container pt-5">
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
                <h3>
                    Заявка №{{ $client->id }}
                </h3>
            </div>
        </div>

        <div class="row pt-5">
            <div class="d-flex justify-content-center">
                <p>
                    <b>ФИО: </b>{{ $client->secondname.' '.$client->firstname.' '.$client->patronymic }}
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p>
                    <b>Адрес: </b>{{ ($client->city_id != NULL ? $client->city->name : '').($client->city_id != NULL ? ', ' : '').$client->address }}
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p>
                    <b>Email: </b>{{ $client->email }}
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p>
                    <b>Телефон: </b>{{ $client->phone }}
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p>
                    <b>Дата заявки: </b>{{ $client->created_at->format('d-m-Y h:m:s') }}
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p>
                    <b>Дата редактирования: </b>{{ $client->updated_at->format('d-m-Y h:m:s') }}
                </p>
            </div>
            
            <div class="d-flex justify-content-center">
                <a href="/manager/client/{{ $client->id }}/edit" class="btn btn-success">Изменить</a>
            </div>
            
            <div class="d-flex justify-content-center pt-5">
                <form action="/manager/client/{{ $client->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>

        
    </div>
@endsection