<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Cemetery;
use App\Models\Service;
use App\Models\Order;


class HomeController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        $Cemeteries = Cemetery::all();
        $services = Service::all();
        return view('Layout_home.master' ,compact('halls', 'Cemeteries', 'services'));
    }

    public function service()
    {
        $services = Service::paginate(9);
        // dd($services);
        return view('Layout_service.master',compact('services'));
    }

    public function prayers()
    {
        return view('Layout_prayers.master');
    }

    public function cemetery()
    {

        // $Cemeteries = Cemetery::all();
        $reservedCemeteryIds = Order::whereNotNull('cemetery_id')->pluck('cemetery_id');
        $Cemeteries = Cemetery::whereNotIn('id', $reservedCemeteryIds)->paginate(9);
        return view('Layout_cemetery.master' ,compact('Cemeteries'));
    }


    public function hall()
    {
        $halls = Hall::paginate(9);
        return view('Layout_hall.master' ,compact('halls'));
    }

    public function Search_halls(Request $request)
    {
        $query = Hall::query();

        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }


        $halls = $query->paginate(9);
        //dd($halls);

        return view('Layout_hall.master', compact('halls'));
    }


    public function Search_Cemeteries(Request $request)
    {
        $query = Cemetery::query();

        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }


        $Cemeteries = $query->paginate(9);
        //dd($Cemeteries);

        return view('Layout_hall.master', compact('Cemeteries'));
    }


    public function Search_services(Request $request)
    {
        $query = Service::query();

        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }


        $services = $query->paginate(9);
        //dd($Cemeteries);

        return view('Layout_hall.master', compact('services'));
    }


}
