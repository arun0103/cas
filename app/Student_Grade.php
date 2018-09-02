<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Grade extends Model
{
    protected $table ='student_grades';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution_id', 'grade_id','name',
        'updated_at','created_at'
    ];

    public function students(){
        return $this->hasMany('App\Student','grade_id','grade_id');
    }
    public function sections(){
        return $this->hasMany('App\Student_Section','grade_id','grade_id');
    }
}
