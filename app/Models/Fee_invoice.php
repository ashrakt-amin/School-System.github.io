<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_date', 'student_id', 'Grade_id', 'Classroom_id',
        'fee_id', 'amount', 'description'
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }


    
    public function grade(){
        return $this->belongsTo(Grade::class , 'Grade_id' ,'id');
    }


    public function class()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id', 'id');
    }


    public function fee(){
        return $this->belongsTo(Fee::class , 'fee_id' ,'id');
    }
}
