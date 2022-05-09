@extends('layouts.app')

@section('content')
    <div class="container pt-5">
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