<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{
   
    public function index()
    {
        $orders = Order::with([
            'user', 
            'bookDurations' => function ($query) {
                $query->with(['service', 'hall']); 
            },
            'cemetery'
        ])->get();
        
        return response()->json(OrderResource::collection($orders), 200);
    }


} 
