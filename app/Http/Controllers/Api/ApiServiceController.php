<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Duration;

class ApiServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Auth::user()->type === 'creator' ? Auth::user()->services : Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'user_id' => 'exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'service' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/servicesimage'), $imageName);
            $validated['image'] = $imageName;
        }

        $validated['is_discount'] = $request->has('is_discount');
        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        $validated['user_id'] = Auth::check() && Auth::user()->type != 'creator' ? $request->user_id : Auth::id();

        $service = Service::create($validated);
        Duration::create(['start_time' => $service->start_time, 'end_time' => $service->end_time, 'service_id' => $service->id]);

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with('users')->findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
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
            'user_id' => 'exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
                unlink(public_path("uploads/servicesimage/{$service->image}"));
            }
            $imageName = 'service' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/servicesimage'), $imageName);
            $validated['image'] = $imageName;
        }

        $validated['is_discount'] = $request->has('is_discount') ? 1 : 0;
        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        $validated['user_id'] = Auth::check() && Auth::user()->type != 'creator' ? $request->user_id : Auth::id();

        $service->update($validated);
        Duration::updateOrCreate(['service_id' => $service->id], ['start_time' => $request->start_time, 'end_time' => $request->end_time]);

        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
            unlink(public_path("uploads/servicesimage/{$service->image}"));
        }
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
