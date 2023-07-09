<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    use HasFactory;
    protected $table='languages';
    protected $fillable=['id','abbr','locale','name','direction','active'];
    public function ScopeActive($query){
        return $query->where('active',1);
    }
    public function ScopeSelecectlangages($query){
        return $query->select('id','abbr','locale','name','direction','active');
    }
    public function getActive(){
        return $this->active?'مفعل':'طغير مفعل';
    }
    
}
