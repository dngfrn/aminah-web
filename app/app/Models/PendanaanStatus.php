<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendanaanStatus extends Model
{
    use HasFactory;
    protected $table = "status_pendanaan";
    protected $primaryKey = "id";
    protected $guarded = ['id']; 

    public function pendanaan(){
        return $this->hasOne(Pendanaan::class,'id','pendanaan_id');
    }
}
