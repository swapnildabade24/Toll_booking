<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
