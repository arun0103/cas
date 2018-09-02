<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table ='students';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'student_id','name','institution_id', 'grade_id', 'section_id','card_number',
        'dob','gender',
        'permanent_address','temporary_address','email',
        'father_name','mother_name', 'guardian_name', 'guardian_relation',
        'contact_1_number','contact_2_number','contact_1_name','contact_2_name', 'sms_option',
        'updated_at','created_at'
    ];

    public function grade(){
        return $this->belongsTo('App\Student_Grade','grade_id','grade_id');
    }
    public function section(){
        return $this->belongsTo('App\Student_Section','section_id','section_id');
    }
    
}
