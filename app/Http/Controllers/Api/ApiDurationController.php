<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DurationResource;
use Illuminate\Http\Request;
use App\Models\Duration;


class ApiDurationController extends Controller
{
    public function index()
    {
        $durations = Duration::all();
        return response()->json(DurationResource::collection($durations));
    }

    public function show($id)
    {
        $duration = Duration::find($id);

        if (!$duration) {
            return response()->json([
                'message' => 'Duration not found']
                , 404);
        }

        return response()->json(new DurationResource($duration));
    }

    public function destroy($id)
    {
        $duration = Duration::find($id);

        if (!$duration) {
            return response()->json(['message' => 'Duration not found'], 404);
        }

        $duration->delete();

        return response()->json(['message' => 'Duration deleted successfully'], 200);
    }
}
