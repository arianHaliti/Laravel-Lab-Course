@extends('layouts.app')

@section('content')
    <h1> {{$title}} </h1>

    @if(count($more)>0)

        <ul class= "list-group">
            @foreach($more as $m)

                <li class= "list-group-item">{{$m}}</li>
            
            @endforeach
        </ul>
    @endif
@endsection