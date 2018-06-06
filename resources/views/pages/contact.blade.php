@extends('layouts.app')

@section('content')
    <div class="container p-0">
    <div class="row mt-0">
            
            <div class="col-md-9 p-0">
                <div class="col-md-12  mt-5">
                

        <h1>Contact Us</h1>
        <div class="row">
            <div class="col-md-6">
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">{{Session::get('flash_message') }}</div>
                @endif
        <form method="post" action="{{ route('contact.store') }}">
            {{csrf_field()}}

            <div class="form-group">
                <label>Name: </label>
                <input type="text" class="form-control" name="name">
                @if ($errors->has('name'))
                <small class"form-text invalid-feedback">{{ $errors->first('name') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label>Email Address: </label>
                <input type="text" class="form-control" name="email">

                @if ($errors->has('email'))
                <small class"form-text invalid-feedback">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label>Message: </label>
                <textarea name="message" class="form-control"></textarea> 

                @if ($errors->has('message'))
                <small class"form-text invalid-feedback">{{ $errors->first('message') }}</small>
                @endif
            </div>

            <button class="btn btn-primary">Submit</button>
        </form>

        </div>
        
        <div class="map-responsive col-md-6" >
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d386950.6511603643!2d-73.70231446529533!3d40.738882125234106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNueva+York!5e0!3m2!1ses-419!2sus!4v1445032011908" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
        </div>
        </div>
        
        
@endsection