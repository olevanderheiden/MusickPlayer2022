@extends('layouts.layout')
@section('content')

<h1>Dit is de lijst van muziek nummers</h1>
<form  method="post" action="{{route('music.search')}}" class="form-inline my-2 my-lg-0">
    @csrf
<input class="form-control mr-sm-2" type="search" placeholder="voer naam in" aria-label="Search" name="search" id="search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
</form>
@if(Auth::user() and Auth::user()->rank == 1)
    <a  class="btn-info btn" href="{{route('music.create')}}">nieuw nummer</a>
@endif
@if($tracks->count()!==0)
<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">
            Naam
        </th>
        <th scope="col">
            Toegevoegd
        </th>
        <th>Details</th>
        @if(Auth::user() and Auth::user()->rank == 1)
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
                {{$track->track}}
            </td>
            <td>
                {{$track->created_at}}
            </td>
            <td><a class="btn btn-dark" href="{{ route('music.show', ['music' => $track->id]) }}">Details</a></td>
            @if(Auth::user() and Auth::user()->rank == 1)
            <td><a  class="btn btn-dark" href="{{ route('music.edit', ['music' => $track->id]) }}">Bewerken</a></td>
                <td><a class="btn btn-dark" href="{{route('music.state',['music'=>$track->id])}}">@if($track->state === 0)
                            Deactief
                        @else Actief
                        @endif</a></td>
            <td><a class="btn btn-danger" href="{{ route('music.delete', ['music' => $track->id]) }}">Verwijderen</a></td>
            @endif
        </tr>
    @endforeach

    </tbody>
</table>
@else
    <h2 class="text-danger">Geen resultaten</h2>
@endif
@endsection


