<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use App\Models\User;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class CemeteryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->type=== 'creator') {
            $cemeteries = Cemetery::where('user_id',auth()->user()->id)->get();
        }
        else{

            $cemeteries = Cemetery::all();
        }

       return  view('cemetery/index', compact('cemeteries'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creators=User::where('type','creator')->get();
        // dd($creators);
        return view('cemetery.create',compact('creators'));
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
            'lat' => 'numeric',
            'long' => 'numeric',
            'size' => 'numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'numeric',
            'is_discount' => 'required|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
            'user_id' => 'exists:users,id',
        ]);
        // dd($data);
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

            // 'user_id' => auth()->id(),

            // 'user_id' => $request->user_id,

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


       $cemetery= Cemetery::create($data);
       session()->flash('success', 'تم اضافة المقبره بنجاح!');
       return redirect()->route('cemetery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cemetry = Cemetery::findOrFail($id);
        if (!$cemetry) {
            return redirect()->route('cemetery.index')->with('error', 'Cemetery not found!');
        }
        // dd($cemetry->user_id);
        return view('cemetery.show', compact('cemetry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cemetery=Cemetery::findOrFail($id);
        $creators=User::where('type','creator')->get();

        return view('cemetery.edit', compact('cemetery','creators'));

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
        'user_id' => 'exists:users,id',
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
        // 'user_id' =>$request->user_id,
    ];
    if (auth()->check() && auth()->user()->type != 'creator') {
        $data['user_id'] = $request->user_id;
    }
    else {
        $data['user_id'] = auth()->id();
    }

    $cemetery=Cemetery::findOrFail($id);
    $cemetery->update($data);
    session()->flash('success', 'تم تحديث المقبره بنجاح!');
    return redirect()->route('cemetery.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cemetery $cemetery)
    {
        if ($cemetery->image && file_exists(public_path("uploads/cemeteryimages/{$cemetery->image}"))) {
            unlink(public_path("uploads/cemeteryimages/{$cemetery->image}"));
        }
        //   dd($cemetry->id);
        $cemetery->delete();
        return redirect()->route('cemetery.index')->with('success', 'تم حذف المقبره بنجاح!');
    }

    public function search(Request $request)
    {

      $query = $request->input('query');
      $cemeteries = Cemetery::where('name', 'like', "%{$query}%")->get();
      return view('cemetery.index', compact('cemeteries'));

    }
}
