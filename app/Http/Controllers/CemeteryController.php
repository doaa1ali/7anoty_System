<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use App\Models\User;

use Illuminate\Http\Request;

class CemeteryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cemeteries = Cemetery::all();
       return  view('cemetry/index', compact('cemeteries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creators=User::where('type','creator')->get();
        // dd($creators);
        return view('cemetry.create',compact('creators'));
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
            'size' => 'numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'numeric',
            'is_discount' => 'required|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
            'user_id' => 'required|exists:users,id',
        ]);
        //  dd($data);
          $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cemetery' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/cemeteryimages'), $imageName);
        }

        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'location'=>$request->location,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'size'=>$request->size,
            'image'=>$imageName,
            'price'=>$request->price,
            'is_discount'=>$request->is_discount,
            'discount'=>$request->discount,
            'user_id' => $request->user_id,
        ];
        if ($request->is_discount == 0) {
            $data['discount'] = null;
        }
        //  dd($data);
       $cemetery= Cemetery::create($data);
       session()->flash('success', 'تم اضافة المقبره بنجاح!');
       return redirect()->route('cemetry.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cemetry = Cemetery::findOrFail($id);
        if (!$cemetry) {
            return redirect()->route('cemetry.index')->with('error', 'Cemetery not found!');
        }
        // dd($cemetry->user_id);
        return view('cemetry.show', compact('cemetry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cemetery=Cemetery::findOrFail($id);
        $creators=User::where('type','creator')->get();

        return view('cemetry.edit', compact('cemetery','creators'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    //    dd($request,$id);
    $data=$request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'required|string',
        'lat' => 'nullable|numeric',
        'long' => 'nullable|numeric',
        'size' => 'numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'price' => 'numeric',
        'is_discount' => 'required|boolean',
        'discount' => 'nullable|numeric|min:0|max:100',
    ]);
    //  dd($data);
      $imageName = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = 'cemetery' . time() . '.' . $image->extension();
        $image->move(public_path('uploads/cemeteryimages'), $imageName);
    }
    $data=[
        'name'=>$request->name,
        'description'=>$request->description,
        'location'=>$request->location,
        'lat'=>$request->lat,
        'long'=>$request->long,
        'size'=>$request->size,
        'image'=>$imageName,
        'price'=>$request->price,
        'is_discount'=>$request->is_discount,
        'discount'=>$request->discount,
        'user_id' =>$request->user_id,
    ];

    $cemetery=Cemetery::findOrFail($id);
    $cemetery->update($data);
    session()->flash('success', 'تم تحديث المقبره بنجاح!');
    return redirect()->route('cemetry.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cemetery $cemetry)
    {
        if ($cemetry->image && file_exists(public_path("uploads/cemeteryimages/{$cemetry->image}"))) {
            unlink(public_path("uploads/cemeteryimages/{$cemetry->image}"));
        }
        //   dd($cemetry->id);
        $cemetry->delete();
        return redirect()->route('cemetry.index')->with('success', 'تم حذف المقبره بنجاح!');
    }

    public function search(Request $request)
    {

      $query = $request->input('query');
      $cemeteries = Cemetery::where('name', 'like', "%{$query}%")->get();
      return view('cemetry.index', compact('cemeteries'));

    }
}
