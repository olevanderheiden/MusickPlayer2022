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

    <form method="POST" action="{{route('music.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">
                Track naam
            </label>
            <input type="text" class="form-control" name="title" id="title"
                   value="{{old('title')}}">

        </div>

        <div class="form-group">
            <label for="cover">
                Cover
            </label>
            <input type="file" name="cover" value="{{old('cover')}}" id="cover">
        </div>
        <div class="form-group">
            <label for="track">
                Track
            </label>
            <input type="file" name="track" value="{{old('track')}}" id="track"
                   aria-describedby="musicCoverHelp" placeholder="Voeg track toe">
        </div>

        <div class="form-group">
            <label for="user_id">Gebruiker</label>
            <select name="user_id" id="user_id" class="form-control">
                @if(Auth::user()->rank == 1)
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if(old('user_id')== $user->id)
                                selected
                        @endif
                    >{{$user->name}}
                    </option>
                @endforeach
                @else
                    <option value="{{Auth::user()->id}}"
                    >{{Auth::user()->name}}
                    </option>
                @endif
            </select>
        </div>

        <button type="submit" class="btn-primary">Voeg nummer toe</button>

    </form>

@endsection
