<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function handleregister(Request $request )
    {

         dd('hhh');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'user' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/userimages'), $imageName);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'image' => $imageName,
            'type' => $request->type ?? 'customer',
        ];
// dd('ssss');
        $user = User::create($data);
        Auth::login($user);
        return view('Layout_home.master');


    }
}
