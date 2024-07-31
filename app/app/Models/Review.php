<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "review";
    protected $primaryKey = "id";
    protected $guarded = ['id']; 
    
    public function pengajuan(){
        return $this->belongsTo(Pengajuan::class);
    }

    public function pendanaan(){
        return $this->hasMany(Pendanaan::class,'review_id','id');
    }
}
