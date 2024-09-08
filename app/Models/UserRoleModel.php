<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;

class UserRoleModel extends Model
{

    protected $table = 'role_users';
 	
    protected $fillable = [
                            'user_id',
                            'role_id',
    					  ];
}
