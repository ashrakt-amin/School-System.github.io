<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model 
{
    use HasTranslations;

    protected $table = 'classrooms';
    public $timestamps = true;
    public $translatable =['class_name'];
    protected $fillable=['class_name','grade_id'];


    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

}