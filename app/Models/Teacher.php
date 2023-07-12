<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    use HasFactory , HasTranslations;
    protected $guard ="teacher";

    public $translatable = ['Name'];
    protected $fillable = ['email','password','Name','Gender_id', 'Specialization_id','Joining_Date','Address'];

    public function specializations(){
        return $this->belongsTo(Specialization::class,'Specialization_id','id');

    }

    public function genders(){
        return $this->belongsTo(Gender::class,'Gender_id','id');

        
    }
}
