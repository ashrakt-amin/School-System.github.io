<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','from_grade','from_Classroom','from_section','to_grade','to_Classroom','to_section',
                           'academic_year' ,'academic_year_new'];


                           
    public function student()
    {
        return $this->belongsTo(Student::class ,'student_id','id');
    }

    public function f_grade()
    {
        return $this->belongsTo(Grade::class,'from_grade','id');
    }

    public function f_classroom()
    {
        return $this->belongsTo(Classroom::class,'from_Classroom','id');
    }

    public function f_section()
    {
        return $this->belongsTo(Section::class,'from_section','id');
    }

    
    public function t_grade()
    {
        return $this->belongsTo(Grade::class,'to_grade','id');
    }
    
    public function t_classroom()
    {
        return $this->belongsTo(Classroom::class,'to_Classroom','id');
    }

    public function t_section()
    {
        return $this->belongsTo(Section::class,'to_section','id');
    }

   


}
