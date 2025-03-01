<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Hall;
use App\Models\Duration;
use App\Models\User;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->type=== 'creator') {
            $halls = Hall::where('user_id',auth()->user()->id)->get();

        }
        else{
        $halls = Hall::all();
        $halls = Hall::with('user')->get();
        }
        return view("hall.index", compact("halls"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creators=User::where('type','creator')->get();

        return view("hall.create",compact('creators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'price' => 'numeric',
            'seats' => 'required|integer',
            'has_buffet' => 'required|boolean',
            'start_time' => 'required',
            'end_time' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'exists:users,id',
        ]);
        //  dd($data);
          $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'hall' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/hallimages'), $imageName);
        }

        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'location'=>$request->location,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'price'=>$request->price,
            'seats'=>$request->seats,
            'has_buffet' => $request->has_buffet,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'image'=>$imageName,
            // 'user_id' => auth()->id(),

        ];
        if (auth()->check() && auth()->user()->type != 'creator') {
            $data['user_id'] = $request->user_id;
        }
        else {
            $data['user_id'] = auth()->id();
        }

        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }
         //dd($data);
       $hall= Hall::create($data);
       $duration =Duration::create([
        'hall_id'=> $hall->id,
        'start_time'=>$hall->start_time,
        'end_time'=> $hall->end_time
    ]);
    //    dd($hall);
    return redirect()->route('hall.index')->with('success', 'تمت إضافة القاعه بنجاح!');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hall = Hall::findOrFail($id);
        if (!$hall) {
            return redirect()->route('hall.index')->with('error', 'hall not found!');
        }

        return view('hall.show', compact('hall'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $halls = Hall::all();
        $hall = Hall::findOrFail($id);
        $creators=User::where('type','creator')->get();

        return view('hall.edit', compact('hall','creators'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the hall by ID
        $hall = Hall::findOrFail($id);

        // Validate the request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'price' => 'numeric',
            'seats' => 'required|integer',
            'has_buffet' => 'required|boolean',
            'start_time' => 'required',
            'end_time' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'exists:users,id',

        ]);

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
        if (auth()->check() && auth()->user()->type != 'creator') {
            $data['user_id'] = $request->user_id;
        }
        else {
            $data['user_id'] = auth()->id();
        }

        // Update hall record
        $hall->update($data);
        $duration = Duration::where('service_id', $hall->id)->first();

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
        // Redirect to hall index with success message
        return redirect()->route('hall.index')->with('success', 'تم تحديث القاعة بنجاح!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {

        if ($hall->image && file_exists(public_path("uploads/hallimages/{$hall->image}"))) {
            unlink(public_path("uploads/hallimages/{$hall->image}"));
        }
        $hall->delete();
        return redirect()->route('hall.index')->with('success','تم حذف القاعه بنجاح');
    }

    public function search(Request $request)
    {

      $query = $request->input('query');
      $halls = Hall::where('name', 'like', "%{$query}%")->get();
      return view('hall.index', compact('halls'));

    }
}
