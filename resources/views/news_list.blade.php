@extends('template.base')

@section('content')
    <h1>Новости</h1>
    @foreach($news as $i => $newsItem)
        @if($i > 0)
            <hr>
        @endif
        <a href="{{ route('news_item', ['slug' => $newsItem->slug]) }}">{{ $newsItem->title }}</a>
        <p>{{ $newsItem->published_at }}
        @if($newsItem->description !== null)
            <p>{{ $newsItem->description }}</p>
        @endif
    @endforeach
    {{ $news->links() }}
@endsection
