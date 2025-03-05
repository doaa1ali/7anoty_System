<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Duration;
use App\Models\BookDuration;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ApiOrderController extends Controller
{

    public function index(Request $req)
    {
        //$user=User::where("access_token",$req->token)->first();

        $orders = Order::with([
            'user',
            'bookDurations' => function ($query) {
                $query->with(['service', 'hall']);
            },
            'cemetery'
        ])->get();
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

    public function store()
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

    //_____________________
    public function checkout(Request $request)
    {
        $cart = json_decode($request->input('cart', '[]'), true);
        // dd($cart);
        if (!is_array($cart) || empty($cart)) {
            return response()->json(['status' => 'error', 'message' => 'السلة فارغة!'], 400);
        }

        $totalPrice = array_sum(array_column($cart, 'price'));

        $order = Order::create([
            'user_id' => Auth::id(),
            'final_price' => $totalPrice,
        ]);

        foreach ($cart as $item) {
            if ($item['type'] === 'cemetery') {
                $order->update(['cemetery_id' => $item['id']]);
            }
            elseif ($item['type'] === 'hall') {
                $duration_hall = Duration::where('hall_id', $item['id'])->first();

                if ($duration_hall) {
                    $existingBooking = BookDuration::where('booking_date', Carbon::now()->toDateString())
                        ->where('duration_id', $duration_hall->id)
                        ->where('hall_id', $item['id'])
                        ->exists();

                    if ($existingBooking) {
                        return response()->json(['status' => 'error', 'message' => 'هذه القاعة غير متاحة للحجز في الوقت الحالي!'], 400);
                    }

                    BookDuration::create([
                        'order_id' => $order->id,
                        'hall_id' => $item['id'],
                        'booking_date' => Carbon::now(),
                        'user_id' => Auth::id(),
                        'duration_id' => $duration_hall->id,
                    ]);
                }
            }
            elseif ($item['type'] === 'service') {
                $duration_service = Duration::where('service_id', $item['id'])->first();

                if ($duration_service) {
                    $existingBooking = BookDuration::where('booking_date', Carbon::now()->toDateString())
                        ->where('duration_id', $duration_service->id)
                        ->where('service_id', $item['id'])
                        ->exists();

                    if ($existingBooking) {
                        return response()->json(['status' => 'error', 'message' => 'هذه الخدمة غير متاحة للحجز في الوقت الحالي!'], 400);
                    }

                    BookDuration::create([
                        'order_id' => $order->id,
                        'service_id' => $item['id'],
                        'booking_date' => Carbon::now(),
                        'user_id' => Auth::id(),
                        'duration_id' => $duration_service->id,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تم إتمام الطلب بنجاح!',
            'order_id' => $order->id
        ], 200);
    }


}
