<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class SpecialityModel extends Model
{
    protected $table = 'speciality';

    protected $primaryKey = "id";

    protected $fillable = [
                            'name',
                            'is_active'
                          ];

}
