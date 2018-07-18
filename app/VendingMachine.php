<?php

namespace App;

use App\Snack;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class VendingMachine extends Model
{
    // Hold an instance of the class
    private static $instance;
    private static $message;
    /**
     * VendingMachine constructor.
     */


    // The singleton method
    public static function getInstance()
    {
        self::$message = '';

        if (!isset(self::$instance)) {
            self::$instance = VendingMachine::find(1)->first();
        }

        return self::$instance;
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function snack()
    {
        return $this->hasMany(Snack::class, 'vending_machine_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'vending_machine_id');
    }

    // when the operation buys nack is performed,
    // calculate change andreset balance
    // #NOTE If only you have a repo to manage buying snacks
    public function buySnack($snack)
    {
        $instance = self::getInstance();

        if ($instance->inserted_money >= $snack->price) {
            //calculate change
            $instance->dispensed_change = $instance->inserted_money - $snack->price;
            $instance->available_change = $instance->available_change - $instance->dispensed_change;
            $instance->inserted_money = 0;
            // #NOTE Better to return the save operation here so you can tell if it succeeded
            $instance->save();

            return true;
        }

        return false;
    }

    // reduce the snack number and update available flag
    public function vendSnack($snack)
    {
        $snack->quantity -= 1;
        $snack->is_available = $snack->quantity > 0 ? 1 : 0;
        $snack->save();
    }
}
