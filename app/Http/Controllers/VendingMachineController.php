<?php

namespace App\Http\Controllers;

use App\Snack;
use App\Order;
use Exception;
use App\VendingMachine;
use App\Constants\Message;
use Illuminate\Http\Request;
use function Sodium\compare;
use App\Exceptions\CodeNotFound;
use App\Exceptions\InsufficientChange;
use App\Exceptions\InvalidMoneyInsertion;

// #NOTE You could define those as class constants
define('ORDER_FAILED', 'FAILED_INSUFF_CHANGE');
define('ORDER_SUCCEEDED', 'SUCCESS');
define('MAX_PER_INSERTION', 20);
define('MAX_PER_TRANSACTION', 50);

class VendingMachineController extends Controller
{
    /**
     * @var VendingMachine
     */
    private $vendingMachine;

    /**
     * VendingMachineController constructor.
     *
     * #NOTE use Dependency Injection to work with dependencies
     * You could bind the vendingMachine instance with the app container like this:
     * app()->singletone('vm', function($app) { return VendingMachine::first();})
     *
     * then use app('vm') anywhere to get the vending machine instance
     */
    public function __construct()
    {
        $this->vendingMachine = VendingMachine::getInstance();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $snacks = Snack::availableSnacks()->get()->toArray();
        $vendingMachine = $this->vendingMachine;
        // #NOTE Usually you don't save things in the list method
        $vendingMachine->save();
        $message = $vendingMachine->message;

        return view('VendingMachine', compact('snacks', 'vendingMachine', 'message'));

//        return response()->json([
//            'results' => $snacks
//        ]);
    }

    // User will insert money and server side gets the amount from the request
    public function insertMoney(Request $request)
    {
        $this->validate(request(), [
            'amount' => 'numeric',
        ]);

        // #NOTE Laravel validation could do those checks and return custom error messages
        if ($request->amount > MAX_PER_INSERTION) {
            // You can insert up to $20 per time
            throw new InvalidMoneyInsertion(Message::INVALID_MONEY);
        }
        // #NOTE This check too could be Laravel way
        if ($request->amount > 0) {
            // updating current user's balance in the machine
            // #NOTE Controllers shouldn't do business logic, but pass the requests to repos, models..
            $this->vendingMachine->inserted_money += $request->amount;
            if ($this->vendingMachine->inserted_money > MAX_PER_TRANSACTION) {
                // The total balance must not exceed $50
                throw new InvalidMoneyInsertion(Message::MONEY_OVERFLOW);
            }
            $this->vendingMachine->dispensed_change = 0;
            $this->vendingMachine->save();
        }

        return redirect('/');
    }

    // selecting a snack, remove one from inventory
    public function selectSnack(Request $request)
    {
        $this->validate(request(), [
            'code' => 'string',
        ]);

        $snack = null;
        try {
            // #NOTE findByCode has FindOrFail anyway, don't need to cache and throw exceptions
            $snack = Snack::findByCode($request->code);
        } catch (Exception $e) {
            throw new CodeNotFound();
        }

        // checks if there is available change to return before making teh transaction
        // #NOTE Business logic shouldn't be here
        if ($this->vendingMachine->available_change < $this->vendingMachine->inserted_money - $snack->price) {
            // reset balance
            $this->vendingMachine->inserted_money  = 0;

            //add a failed order
            Order::addOrder($snack, ORDER_FAILED);

            $this->vendingMachine->save();
            throw new InsufficientChange(Message::INSUFFICIENT_CHANGE);
        }

        // check whether inserted cash covers snack's price
        $isSufficient = $this->vendingMachine->buySnack($snack);
        if ($isSufficient) {
            // add a new order with status succeeded
            Order::addOrder($snack, ORDER_SUCCEEDED);
            //dd($this->vendingMachine);
            // remove the snack and vend it
            $this->vendingMachine->vendSnack($snack);
        } else {             // When the change is not enough in the machine
            throw new InsufficientChange(Message::INSUFFICIENT);
        }

        return redirect('/');//->with(Message::SNACK_DISPENSED .'\n' . Message::HAVE_A_NICE_DAY);
    }
}
