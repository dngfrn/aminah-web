<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = "pengajuan";
    protected $primaryKey = "id";
    protected $guarded = ['id']; 
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function review(){
        return $this->hasOne(Review::class,'pengajuan_id','id');
    }
}
