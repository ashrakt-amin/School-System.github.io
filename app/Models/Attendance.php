<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','grade_id','classroom_id','section_id','teacher_id',
                           'attendance_date' ,'attendance_status'];
                         





}
