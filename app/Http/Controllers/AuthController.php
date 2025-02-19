<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }




    public function register()
    {
        return view ('auth.register');
    }

    public function handleregister(Request $request )
    {
        
        
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
            $imageName = 'hanoty' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/hanotyimages'), $imageName);
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
        
        $user = User::create($data);
        Auth::login($user);
        
        if ($user->type === 'admin') {
            return view('Layout.master');
        } elseif ($user->type === 'creator') {
            return view('Layout_home.master');
        } else {
            return view('Layout_home.master');
        }   

    }

    public function login()
    {
        return view ('auth.login');
    }


    public function handlelogin(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);

        if(Auth::attempt($data))
        {
            $user=Auth::user();
            if($user->type ==='admin' )
                return view('Layout.master');
            elseif($user->type ==='creator')
                return view('Layout_home.master');
            else
                return view('customerLayout.master');
        }

        return back()->withErrors(['email'=> 'invalid email or password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
