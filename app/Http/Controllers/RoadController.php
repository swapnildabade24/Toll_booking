<?php

namespace App\Http\Controllers;

use App\Road;
use Illuminate\Http\Request;

class RoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.road');
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
     * @param  \App\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function show(Road $road)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function edit(Road $road)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Road $road)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function destroy(Road $road)
    {
        //
    }
}
