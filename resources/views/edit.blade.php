<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel 5.5 CRUD Tutorial With Example From Scratch </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <h2>Edit A Snack</h2><br  />
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    <form method="post" action="{{action('SnackController@update', $snack->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{$snack->name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" value="{{$snack->price}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="quantity">Quantity:</label>
                <input type="text" class="form-control" name="quantity" value="{{$snack->quantity}}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Update Snack</button>
            </div>
        </div>

</form>
    <form action="{{action('SnackController@destroy', $snack['id'])}}" method="post">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
</body>
</html>