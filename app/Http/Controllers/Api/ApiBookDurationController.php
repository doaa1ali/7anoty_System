<?php

namespace App\Http\Controllers\Api;
use App\Models\BookDuration;
use App\Http\Resources\BookingResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ApiBookDurationController extends Controller
{
    public function index()
    {
        $bookings = BookDuration::with([
            'user', 'service',
            'hall', 'order','duration']
        )->get();
        return response()->json(BookingResource::collection($bookings), 200);
    }

    public function show($id)
    {
        $booking = BookDuration::with([
            'user', 'service',
            'hall', 'order','duration']
        )->find($id);
        if (!$booking) {
            return response()->json(['message' => 'الحجز غير موجود'], 404);
        }

        return response()->json(new BookingResource($booking), 200);
    }

    public function destroy($id)
    {
        $booking = BookDuration::find($id);

        if (!$booking) {
            return response()->json(['message' => 'الحجز غير موجود'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'تم حذف الحجز بنجاح'], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required|date|after_or_equal:today',
            'user_id' => 'required|exists:users,id',
            'service_id' => 'nullable|exists:services,id',
            'hall_id' => 'nullable|exists:halls,id',
            'duration_id' => 'required|exists:durations,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $validator->validated();

        $query = BookDuration::where('booking_date', $data['booking_date'])
        ->where('duration_id', $data['duration_id'])
        ->where('order_id', $data['order_id'])
        ->where(function ($query) use ($data) {
            if (!empty($data['hall_id'])) {
                $query->where('hall_id', $data['hall_id']);
            }

            if (!empty($data['service_id'])) {
                $query->orWhere('service_id', $data['service_id']);
            }
        });

        if ($query->exists()) {
            return response()->json(['message' => 'هذا الحجز موجود بالفعل'], 422);
        }

        $booking = BookDuration::create($data);
        return response()->json(new BookingResource($booking), 201);
    }

    public function update(Request $request, $id)
    {

        $booking = BookDuration::find($id);

        if (!$booking) {
            return response()->json(['message' => 'الحجز غير موجود'], 404);
        }

        $validator = Validator::make($request->all(), [
            'booking_date' => 'required|date|after_or_equal:today',
            'user_id' => 'required|exists:users,id',
            'service_id' => 'nullable|exists:services,id',
            'hall_id' => 'nullable|exists:halls,id',
            'duration_id' => 'required|exists:durations,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();

        $query = BookDuration::where('booking_date', $data['booking_date'])
        ->where('duration_id', $data['duration_id'])
        ->where('order_id', $data['order_id'])
        ->where('id', '!=', $id) 
        ->where(function ($query) use ($data) {
            if (!empty($data['hall_id'])) {
                $query->where('hall_id', $data['hall_id']);
            }

            if (!empty($data['service_id'])) {
                $query->orWhere('service_id', $data['service_id']);
            }
        });

    if ($query->exists()) {
        return response()->json(['message' => 'هذا الحجز موجود بالفعل'], 422);
    }

    $booking->update($data);

    return response()->json(new BookingResource($booking), 200);
    }

}
