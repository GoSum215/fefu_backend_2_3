@extends('template.base')

@section('content')
    <h2>Войти</h2>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
{{--    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif--}}
    @error('name')
    <p class="error">{{ $message }}</p>
    @enderror
    <form method="POST" action="{{ route('login') }}" class="bordered">
        @csrf
        <div>
            <label>Login</label>
            <input name="login" type="text" value="{{ old('login') }}"/>
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password" />
        </div>
        <input type="submit"/>
    </form>
@endsection
