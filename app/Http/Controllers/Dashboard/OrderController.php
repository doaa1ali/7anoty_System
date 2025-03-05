<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hall;
use App\Models\Cemetery;
use App\Models\Service;
use App\Models\Order;
use App\Models\BookDuration;
use App\Models\Duration;
use Carbon\Carbon;

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


    public function checkout(Request $request)
    {
        // dd('hhhhhhhh');
        $cart = json_decode($request->input('cart', '[]'), true);

        if (!is_array($cart) || empty($cart)) {
            return back()->with('error', 'السلة فارغة!');        }
        //  dd($cart);

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
                //  dd($duration_hall);
                if ($duration_hall) {
                    $existingBooking = BookDuration::where('booking_date', Carbon::now()->toDateString())
                        ->where('duration_id', $duration_hall->id)
                        ->where('hall_id', $item['id'])
                        ->exists();
                        // dd($existingBooking);

                    if ($existingBooking) {
                        return back()->with('error', 'هذه القاعة غير متاحة للحجز في الوقت الحالي!');                    }

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
                        return back()->with('error', 'هذه الخدمة غير متاحة للحجز في الوقت الحالي!');
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

        return view('cart.payment');

    }



    public function processPayment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'payment_method' => 'required'
        ]);
    
        return redirect()->route('home')->with('success', 'تم قبول الطلب وسيتم التواصل معك قريبًا!');
    }
    



}
