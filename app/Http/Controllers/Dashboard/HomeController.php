<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Layout_home.master');
    }

    public function service()
    {
        return view('Layout_service.master');
    }

    public function prayers()
    {
        return view('Layout_prayers.master');
    }
}
