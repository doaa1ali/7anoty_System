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
            return view('Layout_home.master');

        }

        return back()->withErrors(['email'=> 'invalid email or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        // dd(session()->all());
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request )
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

        User::create($data);

        $users = User::all();
        return view('user.index',  compact('users'));

    }


    public function search(Request $request)
    {

      $query = $request->input('query');
      $users = User::where('name', 'like', "%{$query}%")->get();
      return view('user.index', compact('users'));

    }



    public function show($id)
    {

        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->route('auth.index')->with('error', 'User not found!');
        }

        return view('user.show', compact('user'));
    }

    public function destroy(User $user)
    {

        if ($user->image && file_exists(public_path("uploads/userimages/{$user->image}"))) {
            unlink(public_path("uploads/userimages/{$user->image}"));
        }

        $user->delete();

        return redirect()->route('auth.index')->with('success', 'تم حذف المستخدم بنجاح!');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);


        $data_update = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'type' => $request->type ?? 'customer',
        ];


        if ($request->filled('password')) {
            $data_update['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {

            if ($user->image && file_exists(public_path("uploads/userimages/{$user->image}"))) {
                unlink(public_path("uploads/userimages/{$user->image}"));
            }


            $image = $request->file('image');
            $filename = "User_" . time() . '.' . $image->extension();
            $image->move(public_path("uploads/userimages"), $filename);

            $data_update['image'] = $filename;
        }

        $user->update($data_update);

        session()->flash('success', 'تم تحديث بيانات المستخدم بنجاح!');
        return redirect()->route('auth.index');
    }


}
