@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tutte le aule</h1>

    @if($rooms->isEmpty())
        <p>No rooms available.</p>
    @else
        <ul>
            @foreach($rooms as $room)
                <li>{{ $room->name }} - {{ $room->description }} - {{ $room->address }} - {{ $room->size }} mq {{ $room->seats }} posti disponibili</li>
                <!-- Add more room details as needed -->
            @endforeach
        </ul>
    @endif
</div>
@endsection
