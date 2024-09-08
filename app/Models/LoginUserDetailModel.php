<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginUserDetailModel extends Model
{
    protected $table      = "user_details";
    protected $fillable = [
                        		'login_id',
                        		'company_name',
                        		'company_email',
                        		'profile_image',
                        		'first_name',
                        		'last_name',
                        		'mobile_number',
                        		'address',
                        		'city',
                        		'zipcode',
                        		'state',
                        		'country',
                            ];
    public function country_details()
    {
        /*return $this->belongsTo('App\Models\CountryModel','country','country_code');*/
        return $this->belongsTo('App\Models\CountryModel','country','id');
    }
    public function city_details()
    {
        return $this->belongsTo('App\Models\CityModel','city','id');
    }
}
