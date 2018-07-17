<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snack Vending Machine</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="margin-top: 10px">
    <h1 style="text-align: center">Vending Machine</h1>
    <hr>
    <div class="row">
        <div class="col-md-6" style="float:left; border: 2px solid black; background-color: oldlace">
            <table class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                @foreach($snacks as $snack)
                    <tr>
                        <td>{{$snack['code']}}</td>
                        <td>{{$snack['name']}}</td>
                        <td>{{$snack['price']}}</td>
                        <td>{{$snack['quantity']}}</td>
                    </tr>
                @endforeach
                <p>{{$message}}</p>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4" style="margin-left: 100px">
            <form action="{{action('VendingMachineController@insertMoney')}}" method="POST">
                {{csrf_field()}}    <span style="display: block; text-align: center"><b>Balance</b></span>
                <span style="display:block; color: blue; font-size: 25px; font-weight: bold; text-align: center">${{$vendingMachine['inserted_money']}}</span>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Amount to Add" id="usr" name="amount">
                </div>
                <div style="text-align: center">
                        <button type="submit" class="btn btn-primary">Add Cash</button>
                </div>
            </form>
            <form action="{{action('VendingMachineController@selectSnack')}}" method="POST">
                {{csrf_field()}}
                <span style="display: block; margin-top:50px; text-align: center"><b>Code</b></span>
                <div class="input-group mb-3">
                    <input type="text" style="text-align: center" class="form-control" placeholder="Choose snack" id="code" name="code">
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-outline-primary">Buy</button>
                </div>

                <div style="width:200px; margin: auto ;border: 1px solid gray; background-color: lightgray; border-radius: 5px; margin-top: 200px">
                    <span style="display: block; text-align: center">Change</span>
                    <span style="display: block; text-align: center">{{$vendingMachine['dispensed_change']}}</span>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
<script>
    function getChange() {

    }
</script>
</html>
