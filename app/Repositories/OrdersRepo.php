<?php

namespace App\Repositories;
use App\Order;
use App\Snack;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class OrdersRepo{


    public function allOrders()

    {
        //$orders = Order::all()->groupBy('status');
        return  Order::all()->toArray();

    }

    // get today's orders
    public function getTodaysOrders()
    {
        $now = Carbon::now()->toDateString();
        $match = [
            ['created_at', '>=', $now]
        ];
        $orders = Order::where($match)->orderBy('price')->get();

        return $this->addSnackNameToCollectionWithTime($orders, 'price');
    }

    // get finalized orders
    public function getSucceededOrders(){

        $orders = Order::all()->where('status','SUCCESS');
        return $this->addSnackNameToCollectionWithTime($orders, 'price');
    }

    public function getTodaysSucceededOrders(){

        return Order::all()->where('status', 'SUCCESS')->where('created_at', '>=', Carbon::now()->toDateString());
    }

    // avg sale per day
    public function getTodaysAvgSalePerDay(){

        return $this->getTodaysSucceededOrders()->avg('price');
    }


    // Sale of each snack type
    public function totalSalePerSnack(){
        $orders = Order::select(DB::raw('sum(price) as Total_Sale, snack_id'))
            ->where('status', 'SUCCESS')
            ->groupBy('snack_id')
            ->orderBy(DB::raw('count(snack_id)'),'acs')
            ->get();

        return $this->addSnackNameToCollection($orders, 'Total_Sale');

    }

    // total sales
    public function totalSales(){
        $orders = Order::select(DB::raw('sum(price) as Total_Sale, status'))
            ->where('status', 'SUCCESS')
            ->groupBy('status')
            ->get();
//dd($orders);
        return $orders->toArray();

    }

    // Top three bought snacks
    public function mostPopularSnack(){

        $orders = Order::select(DB::raw('count(*) as Frequency, snack_id'))
            //->where('status', 'SUCCESS')
            ->groupBy('snack_id')
            ->orderBy(DB::raw('count(snack_id)'),'acs')
            ->limit(3)
            ->get();

        return $this->addSnackNameToCollection($orders, 'Frequency');
    }

    // takes an array and attach snack name to the corresponding snack id
    // since order column doesn't have snack name
    // and need to send the name of the snack in report to the manager
    public function addSnackNameToCollection($orders, $string){
        $results =array();
        foreach($orders as $order) {
            $results[] = array('snack_name' => Snack::where('id', $order->snack_id)->value('name'),
                                 $string => $order[$string]);
        }
       return $results;
    }

    public function addSnackNameToCollectionWithTime($orders, $string){
        $results =array();
        foreach($orders as $order) {
            $results[] = array('snack_name' => Snack::where('id', $order->snack_id)->value('name'),
                                 $string => $order[$string],
                                'status' => $order->status,
                                'created_at' => $order->created_at ? $order->created_at->toTimeString() : '');
        }
       return $results;
    }

}