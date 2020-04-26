<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TollBooking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source', 'destination', 'vehicel_number', 'vehicel_type', 'journey_date', 'total_toll_cost', 'toll_count', 'toll_names', 'road_names', 'toll_costs'
    ];
}
