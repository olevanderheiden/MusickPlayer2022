@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Tracks</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <nav class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('music.index') }}">Index</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('music.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('music.edit',
                        ['music' => $music->id]) }}">Edit track</a>
            </li>
        </ul>
    </nav>
    <form method="POST" action="{{ route('music.update', ['music' => $music->id]) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title">Track naam</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="tracktitleHelp"
                   value="{{ old('title', $music->track) }}">
        </div>
        <div class="form-group">
            <label for="description">Duur(in deconden)</label>
            <input type="number"  name="duration" id="duration"
                      class="form-control" value="{{ old('duraction', $music->duration) }}">
        </div>
        <div class="form-group">
            <label for="user_id">Artiest</label>
            <select name="user_id" id="user_id" class="form-control">
                @if(Auth::user()->rank == 1)
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                            @if(old('user_id', $music->user_id) == $user->id)
                                selected
                        @endif
                    >{{ $user->name }}</option>
                    @endforeach
                @else
                    <option value="{{Auth::user()->id}}"
                    >{{Auth::user()->name}}
                    </option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
