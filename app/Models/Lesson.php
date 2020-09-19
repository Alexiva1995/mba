<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = ['course_id', 'title', 'slug', 'description', 'url', 'duration'];

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }

    public function materials(){
        return $this->hasMany('App\Models\SupportMaterial');
    }
}
