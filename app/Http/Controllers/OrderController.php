<?php

namespace App\Http\Controllers;

use App\Repositories\OrdersRepo;

class OrderController extends Controller
{

    private $ordersRepo;

    /**
     * OrderController constructor.
     */
    public function __construct(OrdersRepo $ordersRepo)
    {
        $this->ordersRepo = $ordersRepo;
    }

    public function index()
    {
        return response()->json([
            'results' => $this->ordersRepo->allOrders(),
        ]);
    }

    // get today's orders
    public function getTodaysOrders()
    {
        return response()->json([
            'results' => $this->ordersRepo->getTodaysOrders(),
        ]);
    }

    // get finalized orders
    public function getSucceededOrders()
    {

        return response()->json([
            'results' => $this->ordersRepo->getSucceededOrders(),
        ]);
    }

    public function getTodaysSucceededOrders()
    {
        return response()->json([
            'results' => $this->ordersRepo->getTodaysSucceededOrders(),
        ]);
    }

        // avg sale per day
    public function getTodaysAvgSalePerDay()
    {
        return response()->json([
            'results' => $this->ordersRepo->getTodaysAvgSalePerDay(),
        ]);
    }


    // Sale of each snack type
    public function totalSalePerSnack()
    {
        return response()->json([
            'results' => $this->ordersRepo->totalSalePerSnack(),
        ]);
    }

    // Top three bought snacks
    public function mostPopularSnack()
    {
        return response()->json([
            'results' => $this->ordersRepo->mostPopularSnack(),
        ]);
    }

    // total sales
    public function totalSales()
    {
        return response()->json([
            'results' => $this->ordersRepo->totalSales(),
        ]);
    }
}
