<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Duration;
use Illuminate\Support\Str;

class ApiHallController extends Controller
{
    public function store(Request $request)
    {
       
    
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'price' => 'required|numeric',
            'seats' => 'required|integer',
            'has_buffet' => 'required|boolean',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'hall' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/hallimages'), $imageName);
        }
    
        // Prepare data for insertion
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'seats' => $request->seats,
            'has_buffet' => filter_var($request->has_buffet, FILTER_VALIDATE_BOOLEAN),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'image' => $imageName,
            'user_id' => $request->user_id,  // Always assign the logged-in user
           // 'type' => $request->type ?? 'customer',
            //'access_token' => Str::random(64),
        ];
    
        // Handle discount
        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }
    
        // Insert into database
        $hall = Hall::create($data);
    
        // Create duration entry
        Duration::create([
            'hall_id' => $hall->id,
            'start_time' => $hall->start_time,
            'end_time' => $hall->end_time,
        ]);
    
        // Return success response
        return response()->json([
            'message' => 'Hall created successfully!',
            'hall' => $hall
        ], 201);
    }

    public function show($id)
    {
        $hall = Hall::findOrFail($id);
        return response()->json([
            'message' => 'Hall retrieved successfully',
            'hall' => $hall
        ], 200);
    

      //  return response()->json(['error' => 'Hall not found'], 404);

    }


    public function update(Request $request, $id)
    {
        // Find the hall by ID
        $hall = Hall::findOrFail($id);
    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'price' => 'numeric',
            'seats' => 'required|integer',
            'has_buffet' => 'required|boolean',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Prepare the updated data array
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'lat' => $request->lat,
            'long' => $request->long,
            'price' => $request->price,
            'seats' => $request->seats,
            'has_buffet' => filter_var($request->has_buffet, FILTER_VALIDATE_BOOLEAN),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ];
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($hall->image) {
                $oldImagePath = public_path('uploads/hallimages/' . $hall->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Upload new image
            $image = $request->file('image');
            $imageName = 'hall' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/hallimages/'), $imageName);
            $data['image'] = $imageName;
        }
    
        // Update hall record
        $hall->update($data);
    
        // Update or create duration record
        $duration = Duration::where('hall_id', $hall->id)->first();
    
        if ($duration) {
            $duration->update([
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        } else {
            Duration::create([
                'hall_id' => $hall->id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        }
    
        // Return success response
        return response()->json([
            'message' => 'Hall updated successfully!',
            'hall' => $hall
        ], 200);
    }


    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);

        if ($hall->image && file_exists(public_path("uploads/hallimages/{$hall->image}"))) {
            unlink(public_path("uploads/hallimages/{$hall->image}"));
        }
        $hall->delete();
        return response()->json([
            'message' => 'hall deleted successfully',
           
        ], 201);

    }
    





    


}
