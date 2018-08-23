<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveTypes extends Model
{
    protected $table ='company_leave';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leave_id','branch_id','company_id', 
        
        'updated_at','created_at'
    ];
}
