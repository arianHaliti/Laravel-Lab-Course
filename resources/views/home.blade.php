@extends('layouts.app')

@section('content')
<div class="container p-0 mt-5">
    <div class="row justify-content-center p-0 mt-5">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header">My Dashboard</div>

                <div class="card-body p-0 mt-4">
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
