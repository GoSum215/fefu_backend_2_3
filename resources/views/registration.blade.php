@extends('template.base')

@section('content')
    <h2>Регистрация</h2>

    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach

    <form method="POST" action="{{ route('registration') }}" class="bordered">
        @csrf
        <div>
            <label>Login</label>
            <input name="login" type="text" value="{{ old('login') }}"/>
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password" />
        </div>
        <div>
            <label>Name</label>
            <input name="name" type="text" value="{{ old('name') }}"/>
        </div>
        <div>
            <label>E-mail</label>
            <input name="email" type="text" value="{{ old('email') }}"/>
        </div>
        <input type="submit" />
    </form>
@endsection
