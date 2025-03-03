<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',  
            'bookDurations.service', 
            'bookDurations.hall', 
            'cemetery'
        ])->get();
        
        return view('order.index', compact('orders'));
        
    }
}
