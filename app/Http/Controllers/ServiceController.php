<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use App\Models\Hall;
use App\Models\Service;


use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicetype()
    {
        return view ('service.type');
    }

    public function servicehandle(Request $request)
    {
        if($request->type ==='cemetery')
        {
          return view('service.cemetery');
        }
        elseif($request->type ==='hall')
        {
            return view('service.hall');
        }
        elseif($request->type ==='other')
        {
            return view('service.other');
        }
    }

    public function addcemetry(Request $request)
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
        ]);
        // dd($data);
          $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cemetery' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/cemeteryimages'), $imageName);
        }

        $data=[
            'name'=>'cemetery',
            'description'=>$request->description,
            'location'=>$request->location,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'size'=>$request->size,
            'image'=>$imageName,
            'price'=>$request->price,
            'is_discount'=>$request->is_discount,
            'discount'=>$request->discount,
            'user_id' => auth()->id(),

        ];
         dd($data);
       $cemetery= Cemetery::create($data);
       return redirect()->back()->with('success', 'تمت إضافة المقبرة بنجاح!');
    }

    public function addhall(Request $request)
    {

        // dd($request->all());
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
            'user_id' => auth()->id(),

        ];
         dd($data);
       $hall= Hall::create($data);
    //    dd($hall);
       return redirect()->back()->with('success', 'تمت إضافة القاعه بنجاح!');
    }


    public function addotherservice(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric',
        'location' => 'nullable|string',
        'lat' => 'nullable|numeric',
        'long' => 'nullable|numeric',
        'is_discount' => 'required|boolean',
        'discount' => 'nullable|numeric|min:0|max:100',
        'start_time' => 'required',
        'end_time' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //  dd('hhhhhhhhhhhhhh');
          $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'other' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/otherimages'), $imageName);
        }

        $data=[
            'name'=>'cemetery',
            'description'=>$request->description,
            'price'=>$request->price,
            'location'=>$request->location,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'is_discount'=>$request->is_discount,
            'discount'=>$request->discount,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'image'=>$imageName

        ];
        Service::create($data);
       return redirect()->back()->with('success', 'تمت إضافة الخدمه بنجاح!');
    }
}
