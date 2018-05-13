

@extends('layouts.app')

@section('content')
    
    @if(count($questions) >0)
        @foreach($questions as $q)

            <div>
                <h1><a href ="/questions/{{$q->question_id}}">{{$q->question_title}}</a></h1>
                <small>{{$q->created_at}}</small>
            </div>
        @endforeach
    @endif
@endsection


