<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Online_Class extends Model
{
    use HasFactory;

    protected $fillable = [
        'Grade_id', 'Classroom_id', 'section_id', 'user_id', 'meeting_id',
        'topic', 'start_at', 'duration', 'password', 'start_url', 'join_url','integration'
    ];


    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
