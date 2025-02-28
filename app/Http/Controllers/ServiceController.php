<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Duration;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        if (auth()->user()-> type=== 'creator') {
            $services = auth()->user()->services()->get();
        }
        else
        {
            $services = Service::all();
        }
        return view('service.index',compact('services'));
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
            'user_id.exists' => 'المستخدم المحدد غير موجود',
              ];

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

        ], $messages);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);
            $validated['image'] = $imageName;
        }

        if ($imageName) {
            $validated['image'] = $imageName;
        }

        $validated['is_discount'] = $request->has('is_discount');

        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        if (auth()->check() && auth()->user()->type != 'creator') {
            $validated['user_id'] = $request->user_id;
        }
        else {
            $validated['user_id'] = auth()->id();
        }

        //  dd($validated);
        $service =Service::create($validated);
        //in pivot table
        if (auth()->user()->type === 'creator') {
            auth()->user()->services()->attach($service->id);
        } else if ($request->filled('user_id')) {
            User::find($request->user_id)?->services()->attach($service->id);
        }
        //
        $duration =Duration::create([
            'start_time'=>$service->start_time,
            'end_time'=> $service->end_time,
            'service_id'=> $service->id,
            'hall_id'=>null,
        ]);
        return redirect()->route('service.index')->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    public function show($id)
    {
        $service = Service::with('users')->findOrFail($id);
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
        $creators=User::where('type','creator')->get();
        return view('service.update', compact('service','creators'));
    }


    public function update(Request $request, $id)
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
            'user_id.exists' => 'المستخدم المحدد غير موجود',
              ];

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

        ], $messages);

        $service = Service::findOrFail($id);
        $validated['is_discount'] = $request->has('is_discount') ? 1 : 0;
        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path("uploads/servicesimage/{$service->image}"))) {
                unlink(public_path("uploads/servicesimage/{$service->image}"));
            }

            $image = $request->file('image');
            $imageName = 'service' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/servicesimage'), $imageName);

            $validated['image'] = $imageName;
        }


        if (auth()->check() && auth()->user()->type != 'creator') {
            $validated['user_id'] = $request->user_id;
        }
        else {
            $validated['user_id'] = auth()->id();
        }

        $service->update($validated);
        // modify pivot
        if ($request->filled('user_id')) {
            $service->users()->sync([$validated['user_id']]);
        }

        Duration::updateOrCreate(
            ['service_id' => $service->id],
            [
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]
        );
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
