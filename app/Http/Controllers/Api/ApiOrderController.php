<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;


class ApiOrderController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();

        if ($user->type === 'admin') {
            $orders = Order::with(['user', 'cemetery'])->get();
        } else {
            $orders = Order::with('cemetery')->where('user_id', $user->id)->get();
        }
        return response()->json(['orders' => $orders]);
    }
}
