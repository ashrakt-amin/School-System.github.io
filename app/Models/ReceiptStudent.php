<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'student_id', 'debit', 'description'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
