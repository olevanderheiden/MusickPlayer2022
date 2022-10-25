@extends('layouts.layout')
@section('content')
    <h1 class="mt-5">Muziek nummer/Aanmaken</h1>
    <nav class="nav">
        <ul class="nav nav-tabs">
            <li>
                <a class="nav-link" href="{{route('music.index')}}">Index</a>
            </li>
            <li>
                <a class="nav-link active" href="{{route('music.create')}}">Create</a>
            </li>
        </ul>
    </nav>

    @if($errors->any())
        <div class="alert alert-danger">
            <u>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </u>
        </div>
    @endif

    <form method="POST" action="{{route('music.store')}}">
        @csrf

        <div class="form-group">
            <label for="title">
                Boek naam
            </label>
            <input type="text" class="form-control" name="title"
                   value="{{old('title')}}" id="title"
                   aria-describedby="musicnameHelp" placeholder="Vul Boek naam in">

        </div>

        <div class="form-group">
            <label for="tack">
                Muziek nummr
            </label>
            <input type="text" class="form-control" name="track"
                   value="{{old('track')}}" id="track"
                   aria-describedby="bookIsbnHelp" placeholder="Vul namme van het nummer in">
        </div>

        <div class="form-group">
            <label for="user_id">Gebruiker</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if(old('user_id')== $user->id)
                                selected
                        @endif
                    >{{$user->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">Voeg nummer toe</button>

    </form>

@endsection
