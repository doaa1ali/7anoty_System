<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view ('auth.register');
    }

    public function handleregister(Request $request )
    {
    //   dd($request->all());
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'required|string|max:15',
        'location' => 'nullable|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
      ]);

      if($request->hasFile('image')){
        $image= $request->file('image');
        $imgExtension = $image->extension();
        $imageName = 'hanoty'.time().'.'.$imgExtension;
        $image->move(public_path('hanotyimages'),$imageName);
      }else{
          $imageName=null;
      }

      $data=[
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'location' => $request->location,
        'image' => $imageName,
      ];

    //   dd($data);

      $user=User::create($data);
      Auth::login($user);
    //   return redirect()->route('home');
         if($user->type ==='admin' )
         return view('Layout.master');
         else
    // return redirect()->route('home');
        return view('auth.login');

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
            // return redirect()->route('home');
            $user=Auth::user();
            if($user->type ==='admin' )
              return view('Layout.master');
             else
            //  dd('fff');
            return redirect()->route('user.index');
        }

        return back()->withErrors(['email'=> 'invalid email or password']);
    }

    public function logout()
    {
        // dd('jjj');
        Auth::logout();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
