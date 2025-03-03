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

        $orders = Order::whereHas('bookDurations')
        ->with([
            'user',
            'bookDurations' => function ($query) {
                $query->with(['service', 'hall']);
            },
            'cemetery'
        ])
        ->get();

        // $orders = Order::with([
        //     'user',
        //     'bookDurations' => function ($query) {
        //         $query->with(['service', 'hall']);
        //     },
        //     'cemetery'
        // ])->get();
        return response()->json(OrderResource::collection($orders), 200);
    }

    public function show($id)
    {
        $order = Order::with([
            'user',
            'bookDurations' => function ($query) {
                $query->with(['service', 'hall']);
            },
            'cemetery'
        ])->find($id);
        if (!$order) {
            return response()->json(['message' => 'الطلب غير متوفر'], 404);
        }
        // dd('hh');
        return response()->json(new OrderResource($order), 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'الطلب غير موجود'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'تم حذف الطلب بنجاح'], 200);
    }

}
