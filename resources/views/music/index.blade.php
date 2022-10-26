@extends('layouts.layout')
@section('content')

<h1>Dit is de lijst van muziek nummers</h1>

<a  class="btn-info btn" href="{{route('music.create')}}">nieuw nummer</a>
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
        <th>Bewerken</th>
        <th>Verwijderen</th>
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
            <td><a  class="btn btn-dark" href="{{ route('music.edit', ['music' => $track->id]) }}">Bewerken</a></td>
            <td><a class="btn btn-danger" href="{{ route('music.delete', ['music' => $track->id]) }}">Verwijderen</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection


