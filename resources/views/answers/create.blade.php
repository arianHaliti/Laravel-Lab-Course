<div class="row mt-4">
    <div class="col-md-3 pr-2 pl-0">
        <div class="col-md-12 border bg-light pb-2">
            <h6 class="border-bottom py-2">Add An Answer</h6>
            <p class="f-16 ">How to add an answer?</p>
            <p class="f-14">We prefer answers that can solve the problem, not just discussed.</p>
            <p class="f-14">Quisque ac bibendum velit, a dapibus arcu. Etiam maximus, leo quis feugiat pulvinar, 
                arcu orci efficitur arcu, in commodo urna mauris eu lorem.
                 Vivamus lectus ex, ultrices quis tortor ac, luctus maximus ante.</p>
            
                <a href="#" class="f-14">For more visit the help center ></a>
         </div>
    </div>
    <div class="col-md-9 px-2">
@guest
    <h3>You need an account to add an answers</h3>
    <a href='/register'>Register Here</a>
@else        
    {!! Form::open(['id'=>'form','action' => 'AnswerController@store' , 'method'=> 'POST']) !!}
        
        <div class="form-group">
            {{Form::label('body',' ')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>  
        {{Form::hidden('q_id',$question->question_id)}}
        {{Form::submit('Answer',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   
   
@endguest
</div>
</div>