<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupLocationModel extends Model
{
    protected $table = "pickup_location";

    protected $fillable = [ 'location','country','city' ,'is_active'];

    public $timestamps = false;
}
