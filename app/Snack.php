<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snack extends Model
{
    // pattern used by user to get a certain snack

    protected $guarded = ['id', 'is_available', 'quantity'];

    public function scopeAvailableSnacks($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeFindByCode($query, $name)
    {
        return $query->where('code', $name)->firstOrFail();
    }

    public function order()
    {
        return $this->hasMany('App\OrderDetails');
    }

    public function vendingMachine()
    {
        return $this->belongsTo(VendingMachine::class);
    }
}
