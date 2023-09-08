<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return Inertia::render('Portal/PortalIndex');
        // return Inertia::render('Admin/Home');
    }
    public function portal_auth()
    {
        return Inertia::render('Admin/Portal');
    }
}
