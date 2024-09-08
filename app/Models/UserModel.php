<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cmgmyr\Messenger\Traits\Messagable;

class UserModel extends CartalystUser
{
    use Messagable;

    use SoftDeletes;

    protected $table      = "users";
    protected $loginNames = ['email'];

	protected $fillable = [
                        		'email',
                                'password',
                                'last_name',
                                'first_name',
                                'permissions',
                                'profile_image',
                                'is_active',
                                'via_social',
                                'sociality_id',
                                'country',
                                'city',
                                'zip_code',
                                'state',
                                'mobile_no',
                                'address',
                                'fax',
                                'gender',
                                'otp_code',
                                'otp_expiration',
                                'is_otp_verifed',
                                'force_pass_reset',
                                'preferred_language',
                                'zipcode'
                            ];

    
    public function country_details()
    {
        return $this->belongsTo('App\Models\CountryModel','country','country_code');
    }
}
