<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

use Cmgmyr\Messenger\Traits\Messagable;

class UserMasterModel extends CartalystUser
{
    use Messagable;

    protected $table      = "user_master";

    protected $primaryKey = "id";

	protected $fillable = [
                        		'user_type',
                                'pharmacy_name',
                                'profile_image',
                                'first_name',
                                'last_name',
                                'full_name',
                                'email_address',
                                'registration_no',
                                'speciality',
                                'gender',
                                'dob',
                                'phone_code',
                                'mobile_number',
                                'otp',
                                'otp_expiration',
                                'm_pin',
                                'address',
                                'street_number',
                                'street_name',
                                'area',
                                'city',
                                'state',
                                'zipcode',
                                'country',
                                'status',
                                'reg_on'
                          ];

    public function speciality_data()
    {
        return $this->hasMany('App\Models\SpecialityModel','id','speciality');
    }
}
