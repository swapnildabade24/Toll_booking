<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('tolluser');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        return view('user.home');
    }

    public function userList()
    {    
        return view('admin.userList');
    }

    public function userListajax()
    {    
        $user_list = User::get();

        $user_list->each(function ($item, $key) {
            $item->sr_no = $key+1;
            if ($item->role_id == 1) {
                $item->role = "Admin";
            }else {
                $item->role = "User";
            } 
            $item->created_at = date(('Y-m-d H:i:s'), strtotime($item->created_at));

        });

        return DataTables::of($user_list)->make(true);
    }
}
