<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable=['title','amount','Grade_id','Classroom_id','year','description','type_id'];

    public function grade(){
        return $this->belongsTo(Grade::class , 'Grade_id' ,'id');
    }


    public function class(){
        return $this->belongsTo(Classroom::class , 'Classroom_id' ,'id');
    }

    public function type(){
        return $this->belongsTo(feeType::class , 'type_id' ,'id');
    }

}
