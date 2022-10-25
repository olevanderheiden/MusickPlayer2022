@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Boek/Verwijderen</h1>


    <nav class="nav">
        <ul class="nav nav-tabs">
            <li>
                <a class="nav-link" href="{{route('music.index')}}">Index</a>
            </li>
            <li>
                <a class="nav-link" href="{{route('music.create')}}">Create</a>
            </li>
            <li>
                <a class="nav-link active">Verwijderen</a>
            </li>
        </ul>
    </nav>

    @if($errors->any())
        <div class="alert alert-danger">
            <u>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </u>
        </div>
    @endif

    <form method="POST" action="{{route('music.destroy', ['music' => $music->id])}}">
        @method('DELETE')
        @csrf

        <div class="form-group">
            <label for="title">
               Naam
            </label>
            <input type="text" class="form-control" name="title" id="title"
                   aria-describedby="musicTitleHelp" value="{{$music->track}}" disabled="disabled">
        </div>

        <table>
            <thead>
            <tr>
                <th>Maker</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @if(!empty($music->musicCreater))
            @foreach($music->musicCreaters as $creater)

                    <td>
                        {{$creater->user->name}}
                    </td>

            @endforeach
                @else
                    <td>Onbekend</td>
                @endif
            </tr>
            </tbody>
        </table>

        <button type="submit" class="btn-danger">Verwijderen</button>

    </form>

@endsection
