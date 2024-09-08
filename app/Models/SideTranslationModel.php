<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class SideTranslationModel extends Model
{
	//use SoftDeletes;
	
    protected $table='paper_sides_translation';
    
    public $timestamps = false;

    protected $fillable = ['sides_id','name','locale'];
}