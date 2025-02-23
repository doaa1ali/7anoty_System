<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Constructor to apply middleware.
     */
    public function __construct()
    {
        // Restrict all actions to authenticated users
        $this->middleware('auth');

        // Restrict create, store, edit, update, and destroy actions to 'creator' role only
        $this->middleware('creator')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch services created by the logged-in user (if they are a creator)
        if (auth()->user()->role === 'creator') {
            $services = auth()->user()->services;
        } else {
            // If the user is not a creator, show all services (optional, adjust as needed)
            $services = Service::all();
        }

        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ensure only creators can access the create form
        if (auth()->user()->role !== 'creator') {
            abort(403, 'Unauthorized action.');
        }

        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ensure only creators can store services
        if (auth()->user()->role !== 'creator') {
            abort(403, 'Unauthorized action.');
        }

        // Custom validation messages in Arabic
        $messages = [
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',
            'image.required' => 'الصورة مطلوبة.',
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

        // Validation rules
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_discount' => 'nullable|boolean',
            'discount' => 'required_if:is_discount,1|nullable|numeric|min:0|lt:price',
        ], $messages);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        // Associate the service with the logged-in user (creator)
        $validated['user_id'] = auth()->id();

        // Ensure is_discount is boolean
        $validated['is_discount'] = $request->has('is_discount');

        // If discount is not set, make it null
        if (!$validated['is_discount']) {
            $validated['discount'] = null;
        }

        // Save service to database
        Service::create($validated);

        // Redirect with success message
        return redirect()->route('service.index')->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);

        // Ensure only the creator or admin can view the service
        if (auth()->user()->role !== 'creator' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        // Ensure only the creator can edit the service
        if (auth()->user()->role !== 'creator' || $service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('service.update', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        // Ensure only the creator can update the service
        if (auth()->user()->role !== 'creator' || $service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $messages = [
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',
            'discount.lt' => 'قيمة الخصم يجب أن تكون أقل من السعر.',
        ];

        $validated = $request->validate([
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_discount' => 'nullable|boolean',
            'discount' => 'nullable|numeric|min:0|lt:price',
        ], $messages);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        } else {
            $validated['image'] = $service->image;
        }

        $service->update($validated);

        return redirect()->route('service.index')->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        // Ensure only the creator can delete the service
        if (auth()->user()->role !== 'creator' || $service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $service->delete();

        return redirect()->route('service.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}