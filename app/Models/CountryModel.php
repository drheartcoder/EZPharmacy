<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

use \Dimsav\Translatable\Translatable;

class CountryModel extends Model
{
	use Rememberable,Translatable;

	public $translationModel = 'App\Models\CountryTranslationModel';
    public $translationForeignKey = 'country_id';
    public $translatedAttributes = ['country_name','locale'];
	
    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $fillable = ['country_code','iso','phone_code','country_name','is_active'];

    
    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}
