<?php

namespace App\Http\Controllers;

use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Repositories\OrdersRepo;
use App\Manager;
class MailController extends Controller
{
    //
    private $manager;
    // Generates am email report for the manager
    public function send(OrdersRepo $ordersRepo)
    {

        $manager = Manager::getInstance();
        // this is a dummy email since mailtrap doesn't actually send an email,
        // but you get to see it in your mailtrap inbox under sent emails

        $message = "Orders for today: \r\n";
        $orders = $ordersRepo->getTodaysOrders();
        $topThree = $ordersRepo->mostPopularSnack();
        $salePerSnack = $ordersRepo->totalSalePerSnack();

        foreach($orders as $order)
            $message = $message. "Snack's name: ". $order['snack_name']. "\n".'Price: '. $order['price']."\n"
                        .'Status: '.$order['status']. "\nTime: ". $order['created_at']."\n\n" ;

        $message = $message . "\nTop three bought snacks:\n";

        foreach($topThree as $order)
            $message = $message. "Snack's name: ". $order['snack_name']. "\n".'Frequency: '. $order['Frequency']."\n\n";

        $message = $message . "\nTotal sale per snack:\n";

        foreach($salePerSnack as $order)
            $message = $message. "Snack's name: ". $order['snack_name']. "\n".'Total_Sale: '. $order['Total_Sale']."\n\n";


        $message = $message . "\nAverage Sale Per Day:\n". $ordersRepo->getTodaysAvgSalePerDay();

        Mail::to($manager->email)->send(new Mailer($message));

        return response()->json(['message' => $message]);
    }
}
