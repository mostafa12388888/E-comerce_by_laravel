<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vendor;
use App\Observers\mainCategorryObserve;

class main_catagorie extends Model
{
    use HasFactory;
    protected $table='main_catagories';
    protected $fillable=['Translation_lang','Translation_of','name','slug','photo','active','id'];
    public function ScopeActive($query){
        return $query->where('active',1);
    }
    public function getActive(){
        return $this->active?'مفعل':'غير مفعل';
    }
   public function categories(){
    return $this->hasMany(self::class,'Translation_of');
   }
   public function vendors(){
    return $this->hasMany(vendor::class,'catagory_id');
   }
   protected Static function boot(){
    parent::boot();
    main_catagorie::observe(mainCategorryObserve::class);
   }
public function subCategories(){
    return $this->hasMany(subCategories::class,'maincatagory_id','id');
}
}
