<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Rememberable\Rememberable;

use \Dimsav\Translatable\Translatable;

class AreaModel extends Model
{
    use Rememberable,Translatable;
    
    public $translationModel = 'App\Models\AreaTranslationModel';
    public $translationForeignKey = 'area_id';
    public $translatedAttributes = ['area_title'];


    
    //use SoftDeletes;
    protected $table = 'area';
    protected $primaryKey = 'id';
    protected $fillable = ['area_title','city_id','is_active'];

    public function city_details()
    {
        return $this->belongsTo('App\Models\CityModel','city_id','id');
    }
    
    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }

}
