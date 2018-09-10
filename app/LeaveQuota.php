<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveQuota extends Model
{
    //
    protected $table ='leaves_quota';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','company_id','branch_id','employee_id','leave_id',
        'alloted_days','used_days',
        'updated_at','created_at'
    ];
    public function employee(){
        return $this->belongsTo('App\Employee', 'employee_id','employee_id');
    }
    public function branch(){
        return $this->belongsTo('App\Branch','branch_id','branch_id');
    }
    public function leaveMaster(){
        return $this->belongsTo('App\LeaveMaster','leave_id','leave_id');
    }
}
