<?php

namespace App\Http\Controllers;

use Auth;
use App\TollBooking;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;
use App\Notifications\BookingConformation;
use Illuminate\Support\Facades\Validator;

class TollBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 1 ) {
            return view('admin.bookinglist');
        }
        if (Auth::user()->role_id == 2) {
            return view('user.toll');
        }
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
        $validator = Validator::make($request->all(), [
            'source' => ['required'],
            'destination' => ['required'],
        ]);

        if ($validator->fails()) 
        {
            $errorString = implode(",",$validator->messages()->all());
            return response()->json(["error"=>$errorString]);
        }

        if ($request->vehicle_type == "2AxlesAuto" ) {
            $vehicle_type = "Car/Jeep/Van";
        }
        if ($request->vehicle_type == "2AxlesMoto" ) {
            $vehicle_type = "Bike";
        }
        if ($request->vehicle_type == "2AxlesLCV" ) {
            $vehicle_type = "Pickup truck/ Light commercial vehicles";
        }
        $booking = new TollBooking();
        $booking->source = $request->source;
        $booking->user_id = Auth::user()->id;
        $booking->destination = $request->destination;
        $booking->vehicle_number = $request->vehicle_number;
        $booking->vehicle_type = $vehicle_type;
        $booking->toll_count = $request->toll_count;
        $booking->total_toll_cost = $request->total_toll_cost;
        $booking->journey_date = $request->journey_date;
        $booking->toll_names = implode(" ", $request->toll_name);
        $booking->road_names = implode(" ", $request->road_name);
        $booking->toll_costs = implode(" ", $request->toll_price);
        $booking->save();

        // $toll_name = implode(" ", $request->toll_name);

        // return $request->toll_name;
        // return $toll_name;
        // echo "This is store function<br/>";
        // return print_r($request);

        // return gettype($request->source);

        // $return_data = [];
        // foreach ($request as $key => $value) {
        //     return $value;
        //     $return_data[] = $value;
        // }

        // QR Code

        // return QRCode::text('QR Code Generator for Laravel!')->png();   

        // return QrCode::size(250)->generate('ItSolutionStuff.com');
        
        // return QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
        // ->size(500)->generate('Welcome to kerneldev.com!');
        
        // Mail
        
        $user = new User();
        $user->email = Auth::user()->email;   // This is the email you want to send to.
        $user->notify(new BookingConformation()); 

        return view('user.bookingHistory');   
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\TollBooking  $tollBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TollBooking $tollBooking)
    {
        
        if (Auth::user()->role_id == 1 ) {
            $booking_history = TollBooking::get();
        } else {
            $booking_history = TollBooking::Where('user_id', Auth::user()->id)->get();
        } 

        $booking_history->each(function ($item, $key) {
            $item->sr_no = $key+1;
            $item->created_at = date(('Y-m-d H:i:s'), strtotime($item->created_at));
            $item->action = "";
            // $item->toArray();
        });
        return DataTables::of($booking_history)->make(true);
            
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
