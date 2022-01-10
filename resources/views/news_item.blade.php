@extends('template.base')

@section('content')
    <a href="{{ route('news_list') }}">Новости</a>
    <h1>{{ $newsItem->title }}</h1>
    <p>{{ $newsItem->published_at }}</p>
    <p>{{ $newsItem->text }}</p>
@endsection
