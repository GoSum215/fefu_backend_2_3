@extends('template.base')

@section('content')
    <h1>{{ $user->login }}</h1>
    <p> {{ $user->name }}</p>
    <p> {{ $user->email }}</p>
@endsection
