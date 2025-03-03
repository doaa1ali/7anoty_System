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

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        $item = Hall::find($id) ?? Cemetery::find($id) ?? Service::find($id);

        if (!$item) {
            return back()->with('error', 'العنصر غير موجود!');
        }


        $cart[] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
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

        if(!auth::check())
        {
            return redirect()->route('auth.login');
        }

        $cart = Session::get('cart', []);
        $totalPrice = array_sum(array_column($cart, 'price'));

        if (empty($cart)) {
            return back()->with('error', 'السلة فارغة!');
        }

        $ordes= Order::create([
            'user_id' => Auth::id(),
            'final_price' => $totalPrice,
        ]);
        dd($ordes);

        Session::forget('cart');
        return back()->with('success', 'تم إتمام الطلب بنجاح!');
    }


}
