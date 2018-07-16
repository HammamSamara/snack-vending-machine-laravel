<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email',
//    ];

    // Hold an instance of the class
    private static $instance;



    // The singleton method
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = Manager::find(1)->first();
        }
        return self::$instance;
    }

    public function vendingMachine()
    {
        return $this->belongsTo(VendingMachine::class);
    }
}
