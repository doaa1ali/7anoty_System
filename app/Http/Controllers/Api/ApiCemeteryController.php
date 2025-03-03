<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CemeteryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Models\Cemetery;
use App\Models\User;
class ApiCemeteryController extends Controller
{

    public function index()
    {
           $cemeteries = Cemetery::with('user')->get();
            return response()->json(
                ['success' => true,
                'cemeteries' => CemeteryResource::collection($cemeteries) ]
                , 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
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

        $data = $validator->validated();
        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }
        $cemetery = Cemetery::create($data);

        return response()->json([
            'success' => true,
             'message' => 'تمت إضافة المقبرة بنجاح!',
            'data' => new CemeteryResource($cemetery)]
         , 201);
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
            'user_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $imageName=null;
        if ($request->hasFile('image')) {
            if ($cemetery->image && file_exists(public_path("uploads/cemeteryimages/{$cemetery->image}"))) {
                unlink(public_path("uploads/cemeteryimages/{$cemetery->image}"));
            }

            $image = $request->file('image');
            $imageName = 'cemetery_' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/cemeteryimages'), $imageName);
            $cemetery->image = $imageName;
        }

        $data = $validator->validated();
        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }
        
        $cemetery->update($data);
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المقبرة بنجاح!',
             'data' => new CemeteryResource($cemetery)], 200);

    }

    public function show($id)
    {
        $cemetery = Cemetery::find($id);
        if (!$cemetery) {
            return response()->json(['success' => false, 'message' => 'المقبرة غير موجودة!'], 404);
        }

        return response()->json([
            'success' => true,
             'data' => new CemeteryResource($cemetery)]
             , 200);
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
        return response()->json([
            'success' => true,
             'message' => 'تم حذف المقبرة بنجاح!']
             , 200);
    }

}
