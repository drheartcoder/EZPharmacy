<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Dimsav\Translatable\Translatable;

class SideModel extends Model
{   
	protected $table = "paper_sides";

    public $timestamps = false;

    use Translatable;
    
    public $translationModel 	  = 'App\Models\SideTranslationModel';
    public $translationForeignKey = 'sides_id';
    public $translatedAttributes  = ['name'];

    protected $fillable = [
    							'is_active'
    						];

    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}