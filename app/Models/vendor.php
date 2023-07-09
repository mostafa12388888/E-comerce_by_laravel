<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class vendor extends Model
{
    use HasFactory,Notifiable;
    protected $table='vendors';
    protected $fillable=['id','name','password','mobile','address','email','catagory_id','active','logo'];
    protected $hidden=['catagory_id','password'];
    public function scopeActive($querey){
        return $querey->where('active',1)->get();
    }
    public function category (){
        return $this->belongsTo(main_catagorie::class,'catagory_id','id');
    }
    public function getActive(){
        return $this->active?'مفعل':'غير مفعل';
    }
    public function setPasswordAttribute($password){
        if(!empty($password))
        $this->attributes['password']=bcrypt('password');
    }
   
}
