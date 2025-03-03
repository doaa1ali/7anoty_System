<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Cemetery;
use App\Models\Service;


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
        $services = Service::all();
        // dd($services);
        return view('Layout_service.master',compact('services'));
    }

    public function prayers()
    {
        return view('Layout_prayers.master');
    }

    public function cemetery()
    {
        $Cemeteries = Cemetery::all();
        return view('Layout_cemetery.master' ,compact('Cemeteries'));
    }


    public function hall()
    {
        $halls = Hall::all();
        return view('Layout_hall.master' ,compact('halls'));
    }


}
