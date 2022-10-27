@extends('layouts.layout')

@section('content')


    <h1 class="mt-5">Tracks</h1>

    <nav class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('music.index') }}">Index</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('music.create') }}">Create</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('music.show',
                        ['music' => $music->id]) }}">Track Details</a>
            </li>
        </ul>
    </nav>
    <div class="card-header">
        Track
    </div>
    <div class="card-body">
        <h2 class="card-title">{{ $music->title }}</h2>
        <p class="card-text">{{ $music->duration }}</p>
        <p class="card-text"><span class="text-info">Naam:</span> {{ $music->track }}</p>
        <p class="card-text"><span class="text-info">Artiest:</span> {{ $music->user->name }}</p>
        <p class="card-text"><span class="text-info">Duur in seconden:</span> @if(isset($music->duration)){{ $music->duration }}@else Onbekend @endif</p>
        <p class="card-text"><span class="text-info">Gemaakt: </span>{{$music->created_at->format('d-m-Y')}}</p>
        <p class="card-text"><span class="text-info">Bijgewerkt: </span>{{$music->updated_at->format('d-m-Y')}}</>
    </div>

@endsection
