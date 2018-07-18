<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDetails;

class Order extends Model
{
    //
    protected $fillable = ['id', 'vending_machine_id'];

    public function vendingMachine()
    {
        return $this->belongsTo(VendingMachine::class);
    }
    public function snack()
    {
        return $this->belongsTo(Snack::class);
    }

    // adding a new order in both cases transaction success or failure
    // #NOTE This is the order repo job to register orders
    public static function addOrder($snack, $status){
        $order = new Order();
        $order->status = $status;
        $order->snack_id = $snack->id;
        $order->price = $snack->price;
        // #NOTE or just $order->save();
        Order::insert($order->attributesToArray());
    }
}
