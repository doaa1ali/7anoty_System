<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Hall;
use App\Models\Cemetery;
use App\Models\Service;
use App\Models\Order;
use App\Models\BookDuration;
use App\Models\Duration;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request, $type)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $cart = Session::get('cart', []);

        if ($type === 'cemetery') {
            $item = Cemetery::find($request->id);
        } elseif ($type === 'hall') {
            $item = Hall::find($request->id);
        } else {
            return back()->with('error', 'نوع غير معروف!');
        }

     
        if (!$item) {
            return back()->with('error', 'العنصر غير موجود!');
        }

        $cart[] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'type' => $type,
        ];

   
        Session::put('cart', $cart);

        return back()->with('success', 'تمت إضافة العنصر إلى السلة!');
    }




    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $totalPrice = array_sum(array_column($cart, 'price'));

        return view('cart.index', compact('cart', 'totalPrice'));
    }


    public function removeFromCart($index)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            Session::put('cart', array_values($cart));
        }

        return back()->with('success', 'تم حذف العنصر من السلة!');
    }


    public function checkout()
{
    if (!Auth::check()) {
        return redirect()->route('auth.login');
    }

    $cart = Session::get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'السلة فارغة!');
    }

    $totalPrice = array_sum(array_column($cart, 'price'));

    $order = Order::create([
        'user_id' => Auth::id(),
        'final_price' => $totalPrice,
    ]);

    //dd($order);

    foreach ($cart as $item) {
        if (isset($item['type']) && $item['type'] === 'cemetery') {
            $order->update([
                'cemetery_id' => $item['id'],
            ]);
        } else {
            if ($item['type'] === 'hall' || $item['type'] === 'service') {
                
                $duration_hall = Duration::where('hall_id', $item['id'])->first();
                $duration_service = Duration::where('service_id', $item['id'])->first();

            
                if ($duration_hall) {
                    BookDuration::create([
                        'order_id' => $order->id,
                        'item_id' => $item['id'],
                        'booking_date' => Carbon::now(),
                        'item_type' => $item['type'],
                        'user_id' => Auth::id(),
                        'duration_id' => $duration_hall->id, 
                    ]);
                } 
                elseif($duration_service)
                {
                    BookDuration::create([
                        'order_id' => $order->id,
                        'item_id' => $item['id'],
                        'booking_date' => Carbon::now(),
                        'item_type' => $item['type'],
                        'user_id' => Auth::id(),
                        'duration_id' => $duration_service->id, 
                    ]);
                }
                else {
                    return back()->with('error', 'غير متاح الان');
                }
            }
        }
    }

    Session::forget('cart');

    return back()->with('success', 'تم إتمام الطلب بنجاح!');
}



}
