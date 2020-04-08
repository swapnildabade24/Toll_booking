<?php

namespace App\Http\Controllers;

use App\TollBooking;
use Illuminate\Http\Request;

class TollBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bookinglist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TollBooking  $tollBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TollBooking $tollBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TollBooking  $tollBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TollBooking $tollBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TollBooking  $tollBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TollBooking $tollBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TollBooking  $tollBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TollBooking $tollBooking)
    {
        //
    }
}
