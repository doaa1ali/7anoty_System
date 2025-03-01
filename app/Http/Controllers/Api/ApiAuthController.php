<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;


class ApiAuthController extends Controller
{
    public function handleregister(Request $request )
    {

        //dd('hhh');
        $validator = Validator::make($request->all(),[

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',

        ]);

        //dd($validator);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

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
            'access_token' => Str::random(64),
        ];

        $user = User::create($data);

        // Auth::login($user);
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => new UserResource($user),
        ], 201);

    }


    public function handlelogin(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'email'=>'required|email',
            'password'=>'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    
        $new_access_token = Str::random(64);

        $user->update([
            'access_token' => $new_access_token
        ]);

        return response()->json([
            'message' => 'User Login successfully!',
            'user' => new UserResource($user),
        ], 201);
    }


    public function store(Request $request )
    {


        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

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
            'lat' => $request->lat,
            'long' => $request->long,
            'image' => $imageName,
            'type' => $request->type ?? 'customer',
            'access_token' => Str::random(64),
        ];

        $user = User::create($data);

        // Auth::login($user);
        return response()->json([
            'message' => 'User created successfully!',
            'user' => new UserResource($user),
        ], 201);

    }


    public function show($id)
    {

        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['error' => 'User not found!'], 401);
        }

        return response()->json([
            'message' => 'User details fetched successfully!',
            'user' => new UserResource($user),
        ], 201);
    }


    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if ($user->image && file_exists(public_path("uploads/userimages/{$user->image}"))) {
            unlink(public_path("uploads/userimages/{$user->image}"));
        }

        $user->delete();

        return response()->json([
            'message' => 'تم حذف المستخدم بنجاح!',
            'user' => new UserResource($user),
        ], 201);

    }

   

    public function update(Request $request, $id)
    {

        $oldData = User::findOrFail($id);
        $user = User::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:users,email,$id",
            'password' => 'nullable|min:6',
            'phone' => 'sometimes|string|max:15',
            'location' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $data_update = [
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'phone' => $request->phone ?? $user->phone,
            'location' => $request->location ?? $user->location,
            'lat' => $request->lat ?? $user->lat,
            'long' => $request->long ?? $user->long,
            'type' => $request->type ?? $user->type,
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
    
        return response()->json([
            'message_before' => 'بيانات المستخدم قبل التحديث!',
            'old_user' => new UserResource($oldData),
            'message_after' => 'تم تحديث بيانات المستخدم بنجاح!',
            'updated_user' => new UserResource($user),
        ], 200);
        
    }
    
    

}
