<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemodal extends Model
{
    protected $table = "pemodal";
    protected $primaryKey = "id";
    protected $guarded = ['id']; 
    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
