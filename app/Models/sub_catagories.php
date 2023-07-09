<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_catagories extends Model
{
    use HasFactory;
    protected $table='main_catagories';
    protected $fillable=['Translation_lang','parant_id','Translation_of','name','slug','photo','active','id'];

    public function mainCategories(){
        return $this->belongsTo(subCategories::class,'maincatagory_id','id');
    }
}
