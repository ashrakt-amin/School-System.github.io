<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model 
{

    protected $table = 'sections';
    public $timestamps = true;
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name','status','grade_id','class_id'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    public function class()
    {
        return $this->belongsto(Classroom::class);
    }

    
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'teacher_section');
    }

}