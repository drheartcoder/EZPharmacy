<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginModel extends Model
{
     use SoftDeletes;

    protected $table      = "login_master";
    protected $fillable = [
                        		'user_type',
                        		'email_address',
                        		'password',
                        		'registration_date',
                        		'is_active',
                        		'is_verified',
                        		'is_approved',
                                'category_id'

                            ];

    
    public function user_details()
    {
        return $this->belongsTo('App\Models\LoginUserDetailModel','id','login_id');
    }
    
     public function my_files()
    {
        return $this->hasMany('App\Models\MyFileModel','user_id','id');
    }
}
