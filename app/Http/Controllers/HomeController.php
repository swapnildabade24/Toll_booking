<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // User role
       $role = Auth::user()->role_id; 
        
       // Check user role
       switch ($role) {
           case '1':
                return view('admin.home');
               break;
           case '2':
                return view('user.home');
               break; 
           default:
                   return '/login'; 
               break;
       }
    }
}
