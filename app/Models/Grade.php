<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{

    protected $table = 'grades';
    public $timestamps = true;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name','notes'];

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function classes()
    {
        return $this->hasMany('App\Models\Classroom');
    }
}