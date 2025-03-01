<?php

namespace App\Http\Controllers;
use App\Models\Cemetery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ApiCemeteryController extends Controller
{

    public function index()
    {
            if (!auth()->check()) {
                return response()->json(['success' => false, 'message' => 'يلزم التسجيل أولًا'], 401);
            }

            if (auth()->user()->type === 'creator') {
                $cemeteries = Cemetery::where('user_id',auth()->id())
                ->select('name', 'location', 'price', 'size', 'image')
                ->get();
            }

            $cemeteries = Cemetery::select('name', 'location', 'price', 'size', 'image')->get();

            return response()->json(['success' => true,'cemeteries' => $cemeteries ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            // 'lat' => 'nullable|numeric',
            // 'long' => 'nullable|numeric',
            'size' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'numeric',
            'is_discount' => 'required|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
            'user_id' => 'exists:users,id',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cemetery_' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/cemeteryimages'), $imageName);
        }

        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'location'=>$request->location,
            // 'lat'=>$request->lat,
            // 'long'=>$request->long,
            'size'=>$request->size,
            'image'=>$imageName,
            'price'=>$request->price,
            'is_discount'=>$request->is_discount,
            'discount'=>$request->discount,
        ];
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'يلزم التسجيل أولًا'], 401);
        }

        if (auth()->check() && auth()->user()->type != 'creator') {
            $data['user_id'] = $request->user_id;
        }
        else {
            $data['user_id'] = auth()->id();
        }

        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }

        $cemetery = Cemetery::create($data);

        return response()->json(['success' => true, 'message' => 'تمت إضافة المقبرة بنجاح!', 'data' => $cemetery], 201);
    }

    public function update(Request $request, $id)
    {
        $cemetery = Cemetery::find($id);
        if (!$cemetery) {
            return response()->json(['success' => false, 'message' => 'المقبرة غير موجودة!'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'size' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric',
            'is_discount' => 'required|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        if ($request->hasFile('image')) {
            if ($cemetery->image && file_exists(public_path("uploads/cemeteryimages/{$cemetery->image}"))) {
                unlink(public_path("uploads/cemeteryimages/{$cemetery->image}"));
            }

            $image = $request->file('image');
            $imageName = 'cemetery_' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/cemeteryimages'), $imageName);
            $cemetery->image = $imageName;
        }

        $cemetery->update($request->except('image'));
        return response()->json(['success' => true, 'message' => 'تم تحديث المقبرة بنجاح!', 'data' => $cemetery], 200);

    }

    public function show($id)
    {
        $cemetery = Cemetery::find($id);
        if (!$cemetery) {
            return response()->json(['success' => false, 'message' => 'المقبرة غير موجودة!'], 404);
        }

        return response()->json(['success' => true, 'data' => $cemetery], 200);
    }

    public function destroy($id)
    {
        $cemetery = Cemetery::find($id);
        if (!$cemetery) {
            return response()->json(['success' => false, 'message' => 'المقبرة غير موجودة!'], 404);
        }

        if ($cemetery->image && file_exists(public_path("uploads/cemeteryimages/{$cemetery->image}"))) {
            unlink(public_path("uploads/cemeteryimages/{$cemetery->image}"));
        }

        $cemetery->delete();

        return response()->json(['success' => true, 'message' => 'تم حذف المقبرة بنجاح!'], 200);
    }

}
