<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaperModel extends Model
{
    use SoftDeletes;

    protected $table = "paper";
    protected $fillable = ['is_active','paper_type','paper_size','paper_weight'];
}
