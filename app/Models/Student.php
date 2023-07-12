<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use HasFactory ,HasTranslations ,SoftDeletes;

    protected $guard ="student";
    public $translatable = ['name'];
    protected $fillable = ['name','email','password','Date_Birth','academic_year','gender_id',
                          'nationalitie_id','blood_id','Grade_id','Classroom_id','section_id',
                          'parent_id'];



    public function class()
    {
        return $this->belongsto(Classroom::class , 'Classroom_id' ,'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id' , 'id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id' , 'id');
    }

    
    public function Nationality()
    {
        return $this->belongsTo(Nationalitie::class, 'nationalitie_id' , 'id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id' , 'id');
    }

    public function Parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id', 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id','id');
    }

}
