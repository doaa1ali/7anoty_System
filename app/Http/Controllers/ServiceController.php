<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use App\Models\Duration;
use App\Models\Hall;
use App\Models\Service;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        if (auth()->user()-> type=== 'creator') {
            // $services = Service::where('user_id',auth()->user()->id)->get();
        //     if(ser->user_id===null){
        //     $creators=User::where('type','creator')->get();
        //   return redirect()->route('service.create',compact('$creators'));

            $services = Service::where('user_id',auth()->user()->id)->get();
        }
        else 
        {
            $services = Service::all();
        }

        return view('service.index', compact('services'));
    }


    public function create()
    {

        $creators=User::where('type','creator')->get();
        return view('service.create',compact('creators'));
       
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

        $service =Service::create(attributes: $validated);
        $duration =Duration::create([
            'service_id'=> $service->id,
            'start_time'=>$service->start_time,
            'end_time'=> $service->end_time 
        ]);

        $order=Order::create([
            'final_price'=> $service->price,
            'user_id'=>$service->user_id,
            'service_id'=>$service->service_id

        ]);
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
}
