<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Rememberable\Rememberable;

class FrontSliderTranslationModel extends Model 
{
	use Rememberable;
	
	protected $table = 'front_slider_translation';
	
    public $timestamps = false;
    protected $fillable = ['slider_id','title','text1','text2','text3','image','link','locale'];
}