<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;

class RoleModel extends Model
{

    protected $table = 'roles';
 	
    protected $fillable = [
                            'slug',
                            'name',
                            'permissions',     
    					  ];
}
