@extends('layouts.app')

@section('content')
    Hello, manager - {{ Auth::guard('manager')->user()->name }}!
    <a href="{{ route('logout') }}" class="btn btn-danger">Выход</a>
@endsection