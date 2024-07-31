<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    use HasFactory;
    protected $table = "pendanaan";
    protected $primaryKey = "id";
    protected $guarded = ['id']; 

    public function review(){
        return $this->belongsTo(Review::class,'review_id','id');
    }
    public function pemodal(){
        return $this->belongsTo(Pemodal::class,'pemodal_id','user_id');
    }

    public function statusPendanaan(){
        return $this->belongsTo(PendanaanStatus::class,'id','pendanaan_id');
    }
    // public function statusPendanaan()
    // {
    //     return $this->hasOne(PendanaanStatus::class, 'pendanaan_id');
    // }

    
}
