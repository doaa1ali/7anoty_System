<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use App\Models\Hall;
use App\Models\Service;
<<<<<<< HEAD
=======


>>>>>>> origin/hall_crud
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
<<<<<<< HEAD
         dd($data);
=======
         //dd($data);
>>>>>>> origin/hall_crud
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
<<<<<<< HEAD
         dd($data);
=======
         //dd($data);
>>>>>>> origin/hall_crud
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
<<<<<<< HEAD
    /*
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('creator')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    */
    public function index()
    {
        if (auth()->user()->role === 'creator') {
            $services = auth()->user()->services;
        } else {
            $services = Service::all();
        }

        return view('service.index', compact('services'));
    }


    public function create()
    {

        return view('service.create');
    }


    public function store(Request $request)
    {

        $messages = [
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',
            'image.image' => 'الملف يجب أن يكون صورة.',
            'description.required' => 'وصف الخدمة مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',
            'price.min' => 'السعر يجب أن يكون أكبر من أو يساوي 0.',
            'location.required' => 'الموقع مطلوب.',
            'start_time.required' => 'وقت البدء مطلوب.',
            'start_time.date_format' => 'صيغة وقت البدء غير صحيحة.',
            'end_time.required' => 'وقت الانتهاء مطلوب.',
            'end_time.date_format' => 'صيغة وقت الانتهاء غير صحيحة.',
            'end_time.after' => 'وقت الانتهاء يجب أن يكون بعد وقت البدء.',
            'discount.required_if' => 'قيمة الخصم مطلوبة عند تفعيل خيار الخصم.',
            'discount.numeric' => 'يجب أن تكون قيمة الخصم رقماً.',
            'discount.lt' => 'قيمة الخصم يجب أن تكون أقل من السعر.',
        ];

        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_discount' => 'nullable|boolean',
            'discount' => 'required_if:is_discount,1|nullable|numeric|min:0|lt:price',
        ], $messages);


        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);
        }


        if ($imageName) {
            $validated['image'] = $imageName;
        }

        $validated['user_id'] = auth()->id();

        $validated['is_discount'] = $request->has('is_discount');

        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        Service::create($validated);

        return redirect()->route('service.index')->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('service.show', compact('service'));
    }

    public function search(Request $request)
    {

      $query = $request->input('query');
      $services = Service::where('name', 'like', "%{$query}%")->get();
      return view('service.index', compact('services'));

    }
  
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('service.update', compact('service'));
    }


    public function update(Request $request, $id)
    {
  
        $messages = [
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',
            'discount.lt' => 'قيمة الخصم يجب أن تكون أقل من السعر.',
        ];

        $validated = $request->validate([
            'name'=>'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_discount' => 'sometimes|boolean',
            'discount' => 'sometimes|nullable|numeric|min:0|lt:price',
        ], $messages);
    
        $service = Service::findOrFail($id);

        $validated['is_discount'] = $request->has('is_discount') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
                unlink(public_path("uploads/servicesimage/{$service->image}"));
            }

            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);

            $validated['image'] = $imageName;
        }
    

        $service->update($validated);

        return redirect()->route('service.index')->with('success', 'تم تحديث الخدمة بنجاح.');
    }
    



    public function destroy(string $id)
    {

        $service = Service::findOrFail($id);

        if ($service->image && file_exists(public_path("uploads/userimages/{$service->image}"))) {
            unlink(public_path("uploads/servicesimage/{$service->image}"));
        }

        $service->delete();

        return redirect()->route('service.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
=======
>>>>>>> origin/hall_crud
}
