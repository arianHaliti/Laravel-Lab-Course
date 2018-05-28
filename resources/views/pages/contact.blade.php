    
<!DOCTYPE html>
<html labg"en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-eqiuv="X-UA-Compatibile" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        .ivalid-feedback{
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
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
        </div>
        </div>
        
        
</body>
</html>    