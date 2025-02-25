<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function register()
    {
        return view ('auth.register');
    }

    public function handleregister(Request $request )
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'user' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/userimages'), $imageName);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'image' => $imageName,
            'type' => $request->type ?? 'customer',
        ];
// dd('ssss');
        $user = User::create($data);
        Auth::login($user);
        return view('Layout_home.master');

        

    }

    public function login()
    {
        return view ('auth.login');
    }


    public function handlelogin(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);

        if(Auth::attempt($data))
        {
            $user=Auth::user();
            return view('Layout_home.master');

        }

        return back()->withErrors(['email'=> 'invalid email or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        // dd(session()->all());
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request )
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'user' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/userimages'), $imageName);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'image' => $imageName,
            'type' => $request->type ?? 'customer',
        ];

        User::create($data);

        $users = User::all();
        return view('user.index',  compact('users'));

    }


    public function search(Request $request)
    {

      $query = $request->input('query');
      $users = User::where('name', 'like', "%{$query}%")->get();
      return view('user.index', compact('users'));

    }



    public function show($id)
    {

        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->route('auth.index')->with('error', 'User not found!');
        }

        return view('user.show', compact('user'));
    }

    public function destroy(User $user)
    {

        if ($user->image && file_exists(public_path("uploads/userimages/{$user->image}"))) {
            unlink(public_path("uploads/userimages/{$user->image}"));
        }

        $user->delete();

        return redirect()->route('auth.index')->with('success', 'تم حذف المستخدم بنجاح!');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|min:6',
            'phone' => 'required|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);


        $data_update = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'type' => $request->type ?? 'customer',
        ];


        if ($request->filled('password')) {
            $data_update['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {

            if ($user->image && file_exists(public_path("uploads/userimages/{$user->image}"))) {
                unlink(public_path("uploads/userimages/{$user->image}"));
            }


            $image = $request->file('image');
            $filename = "User_" . time() . '.' . $image->extension();
            $image->move(public_path("uploads/userimages"), $filename);

            $data_update['image'] = $filename;
        }

        $user->update($data_update);

        session()->flash('success', 'تم تحديث بيانات المستخدم بنجاح!');
        return redirect()->route('auth.index');
    }


}


// html code++++++++++++++++++++++++++
//           <div class="row mb-3">
//                             <div class="col-md-12">
//                                 <label class="fs-6 fw-bold">{{ __('Pickup your location') }}</label>
//                                 <div class="text-center">
//                                     <div id="googleMap"
//                                         style="width: 100%;min-height:300px;border:1px solid #009EF7; border-radius: 10px;">
//                                     </div>
//                                     <input type="hidden" id="lat_inp" name="lat">
//                                     <input type="hidden" id="lng_inp" name="lon">
//                                     <p class="invalid-feedback" id="lat"></p>
//                                 </div>
//                             </div>
//                         </div>


// html code++++++++++++++++++++++++++


// JS code++++++++++++++++++++++++++++
//     <script>
//         let lat = 30.0444; // Cairo, Egypt
//         let lng = 31.2357; // Cairo, Egypt
//         const isEditPage = false;
//         const isShowPage = false;
//     </script>
//     <script >
// var geocoder;
// var googleMap;
// var marker;
// var autocomplete;

// function myMap() {
//     var myLatlng = { lat: lat, lng: lng };

//     var mapProp = {
//         center: myLatlng,
//         zoom: 12,
//     };

//     googleMap = new google.maps.Map(
//         document.getElementById("googleMap"),
//         mapProp
//     );

//     marker = new google.maps.Marker({
//         position: mapProp.center,
//         map: googleMap,
//         animation: google.maps.Animation.DROP,
//         draggable: true,
//     });

//     geocoder = new google.maps.Geocoder();

//     // Initialize Google Places Autocomplete
//     autocomplete = new google.maps.places.Autocomplete(
//         document.getElementById("location_inp")
//     );
//     autocomplete.addListener("place_changed", function () {
//         var place = autocomplete.getPlace();
//         if (!place.geometry) {
//             console.log("No details available for input: '" + place.name + "'");
//             return;
//         }

//         // Move marker & update map
//         googleMap.setCenter(place.geometry.location);
//         googleMap.setZoom(14);
//         marker.setPosition(place.geometry.location);

//         // Update lat/lng hidden fields
//         document.getElementById("lat_inp").value =
//             place.geometry.location.lat();
//         document.getElementById("lng_inp").value =
//             place.geometry.location.lng();
//     });

//     // Click event to update marker & get address
//     googleMap.addListener("click", function (mapsMouseEvent) {
//         let clickLocation = mapsMouseEvent.latLng;
//         marker.setPosition(clickLocation);

//         geocoder.geocode(
//             { location: clickLocation },
//             function (results, status) {
//                 if (status === "OK" && results[0]) {
//                     document.getElementById("location_inp").value =
//                         results[0].formatted_address;
//                     document.getElementById("lat_inp").value =
//                         clickLocation.lat();
//                     document.getElementById("lng_inp").value =
//                         clickLocation.lng();
//                 } else {
//                     console.log("Geocode error: " + status);
//                 }
//             }
//         );
//     });

//     // Drag marker to update address
//     marker.addListener("dragend", function () {
//         var position = marker.getPosition();
//         geocoder.geocode({ location: position }, function (results, status) {
//             if (status === "OK" && results[0]) {
//                 document.getElementById("location_inp").value =
//                     results[0].formatted_address;
//                 document.getElementById("lat_inp").value = position.lat();
//                 document.getElementById("lng_inp").value = position.lng();
//             }
//         });
//     });
// }

// // Get current location
// function getCurrentPos() {
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(function (position) {
//             var pos = {
//                 lat: position.coords.latitude,
//                 lng: position.coords.longitude,
//             };
//             marker.setPosition(pos);
//             googleMap.setCenter(pos);
//             googleMap.setZoom(14);

//             geocoder.geocode({ location: pos }, function (results, status) {
//                 if (status === "OK" && results[0]) {
//                     document.getElementById("location_inp").value =
//                         results[0].formatted_address;
//                     document.getElementById("lat_inp").value = pos.lat;
//                     document.getElementById("lng_inp").value = pos.lng;
//                 }
//             });
//         });
//     } else {
//         console.log("Geolocation is not supported.");
//     }
// }

// </script>
//     <script async defer
//         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu4T0sSqqn87uvqXHcUbbWpxt4NVyBW6w
//                                                                                                                                                                                                                                                                                                                                                                                                     &loading=async&libraries=places,drawing&callback=myMap&language=ar&region=EG">
//     </script>
// JS code++++++++++++++++++++++++++++