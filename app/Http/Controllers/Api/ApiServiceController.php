<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\User;
use App\Models\Duration;


use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function index()
    {
           $services = Service::all();
            return response()->json(
                ['success' => true,
                'services' => ServiceResource::collection($services) ]
                , 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'lat' => 'numeric',
            'long' => 'numeric',
            'is_discount' => 'nullable|boolean',
            'discount' => 'required_if:is_discount,1|nullable|numeric|min:0|lt:price',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);
            $data['image'] = $imageName;
        }

        $data['is_discount'] = $request->has('is_discount');

        if (!$data['is_discount']) {
            $data['discount'] = null;
        }

        $service = Service::create($data);
        $user = User::find($request->user_id);
        $user->services()->attach($service->id);

        Duration::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'service_id' => $service->id,
            'hall_id' => null,
        ]);
        return response()->json([
            'message' => 'تم إنشاء الخدمة بنجاح',
             'service' => new ServiceResource($service)]
             , 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'الخدمة غير موجودة'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
             'description' => 'required|string',
             'price' => 'required|numeric|min:0',
             'location' => 'required|string',
             'lat' => 'numeric',
             'long' => 'numeric',
             'is_discount' => 'nullable|boolean',
             'discount' => 'required_if:is_discount,1|nullable|numeric|min:0|lt:price',
             'start_time' => 'required|date_format:H:i',
             'end_time' => 'required|date_format:H:i|after:start_time',
             'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'user_id' => 'required|exists:users,id',
         ]);

         if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
                unlink(public_path("uploads/servicesimage/{$service->image}"));
            }

            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);
            $data['image'] = $imageName;
        }

        $service->update($data);
        //update pivot
        $user = User::find($request->user_id);
        $service->users()->sync([$user->id]);

        //update duration
        $duration =Duration::where('service_id', $service->id)->first();
       if ($duration) {
        $duration->update([
            'start_time' => $request->start_time ?? $duration->start_time,
            'end_time' => $request->end_time ?? $duration->end_time,
        ]);
       }

       return response()->json([
        'message' => 'تم تحديث الخدمة بنجاح',
         'service' => new ServiceResource($service)]
         , 200);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'الخدمة غير موجودة'], 404);
        }

        return response()->json([
            'service' => new ServiceResource($service)]
            , 200);
    }

   public function destroy($id)
   {
    $service = Service::find($id);

    if (!$service) {
        return response()->json(['message' => 'الخدمة غير موجودة'], 404);
    }
    if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
        unlink(public_path("uploads/servicesimage/{$service->image}"));
    }

    $service->delete();
    return response()->json(['message' => 'تم حذف الخدمة بنجاح'], 200);
   }
}
