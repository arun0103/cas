<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table ='designations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation_id','name',  'company_id',
        'updated_at','created_at'
    ];
    public function employees(){
        return $this->hasMany('App\Employee','designation_id','designation_id');
    }
}
