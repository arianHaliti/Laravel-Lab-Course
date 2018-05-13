@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($questions)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>

                        @foreach($questions as $q )
                        <tr>
                            <td>{{$q->question_title}}</td>
                            <td><a href="/questions/{{$q->question_id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>
                                    {!! Form::open(['action' => ['QuestionController@destroy' , $q->question_id] ,'method'=> 'POST']) !!}
        
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                            </td>
                        </tr>                                
                        @endforeach
                    </table>
                    @else
                    <p>You have no Questions</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
