@extends('layouts.layout')
@section('content')

    <h1>Dit is de lijst van muziek nummers</h1>
    <form method="post" action="{{route('music.search')}}" class="form-inline my-2 my-lg-0">
        @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="voer naam in" aria-label="Search" name="search"
               id="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
    </form>
    @if(Auth::user())
        <a class="btn-info btn" href="{{route('music.create')}}">nieuw nummer</a>
    @endif
    @if($tracks->count()!==0)
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">
                    Cover
                </th>
                <th scope="col">
                    Naam
                </th>
                <th scope="col">
                    Afspelen
                </th>
                <th scope="col">
                    Toegevoegd
                </th>
                <th>Details</th>
                @if(Auth::user())
                    <th>Bewerken</th>
                    <th>Status</th>
                    <th>Verwijderen</th>
                @endif
            </tr>
            </thead>
            <tbody>

            @foreach($tracks as $track)
                <tr>
                    <td>
                        @if(isset($track->cover_file_path))
                            <img width="100ren" height="100ren" src="{{asset('storage/covers/'.$track->cover_file_path)}}">
                        @else
                            <p>Niet beschickbaar</p>
                        @endif
                    </td>
                    <td>
                        {{$track->track}}
                    </td>
                    <td>
                        @if(isset($track->file_path))
                                <audio controls="controls">
                                    <source src="{{asset('storage/tracks/'.$track->file_path)}}">
                                </audio>
                        @else
                        niet beschickbaar
                        @endif
                    </td>
                    <td>
                        {{$track->created_at->format('d-m-Y')}}
                    </td>
                    <td><a class="btn btn-dark" href="{{ route('music.show', ['music' => $track->id]) }}">Details</a>
                    </td>
                    @if(Auth::user() and Auth::user()->rank == 1 or  $track->user_id === Auth::id())
                        <td><a class="btn btn-dark"
                               href="{{ route('music.edit', ['music' => $track->id]) }}">Bewerken</a></td>
                        <td><a class="btn btn-dark"
                               href="{{route('music.state',['music'=>$track->id])}}">@if($track->state === 0)
                                    Deactief
                                @else
                                    Actief
                                @endif</a></td>
                        <td><a class="btn btn-danger" href="{{ route('music.delete', ['music' => $track->id]) }}">Verwijderen</a>
                        </td>
                    @elseif(Auth::user())
                        <td><a disabled="" href="" class="btn btn-warning text-danger">niet mogelijk</a></td>
                        <td><a disabled="" href="" class="btn btn-warning text-danger">niet mogelijk</a></td>
                        <td><a disabled="" href="" class="btn btn-warning text-danger">niet mogelijk</a></td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    @else
        <h2 class="text-danger">Geen resultaten</h2>
    @endif
@endsection


