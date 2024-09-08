<?php

namespace App\Models; 
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Rememberable\Rememberable;

class FrontSliderModel extends Eloquent
{
    use Rememberable;
	use Translatable;
    use SoftDeletes;

    protected $table = 'front_slider'; 

    /* Translatable Config */
    public $translationModel      = 'App\Models\FrontSliderTranslationModel';
 	public $translationForeignKey = 'slider_id';
    public $translatedAttributes  = ['image','title','text1','text2','text3','image_alt','link','locale'];
    protected $fillable           = ['public_key','image','order_index','start_date','end_date'];


   /* public function parent_property_type()
    {
    	return $this->belongsTo('App\Models\PropertyTypeModel','parent','id');
    }

    public function child_property_type()
    {
        return $this->hasMany('App\Models\PropertyTypeModel','parent','id');
    }
   */ 

    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}
