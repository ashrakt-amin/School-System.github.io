<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['name','subject_id','grade_id','classroom_id','section_id','teacher_id'];

    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    } 
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    } 

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    } 

    public function questions()
    {
        return $this->hasMany(Question::class);
    } 

    
}