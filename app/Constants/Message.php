<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    const INSUFFICIENT ="The amount you entered is insufficient";
    const INSUFFICIENT_CHANGE ="Sorry, we don't have enough change, operation aborted";
    const SNACK_DISPENSED = "Please get your snack from the slot.";
    const INVALID_ENTRY = "Invalid entry, pick a code corresponds with snack slot";
    const TAKE_THE_CHANGE = "Please collect the change";
    const INVALID_MONEY = "The machine accepts up to $20 per time";
    const MONEY_OVERFLOW = "Maximum capacity is $50, you can't insert anymore";
    const OUT_OF_STOCK = "Sorry, the item you have selected is out of stock";
    const HAVE_A_NICE_DAY = "Have A nice Day";
}
