<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punch extends Model
{
    protected $table ='punch_records';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id','branch_id','dept_id','company_id', 'category_id','roster_id',
        'punch_date','punch_1','punch_2','punch_3','punch_4','punch_5','punch_6',
        'early_in','early_out','late_in','overstay','overtime','comp_off','comp_off_avail',
        'shift_code','hour_worked_minutes','half_1','half_2','half_1_gate_pass','half_2_gate_pass',
        'half_1_gp_out','half_1_gp_in','half_1_gp_hrs',
        'half_2_gp_out','half_2_gp_in','half_2_gp_hrs',
        'final_half_1','final_half_2',
        'remarks',
        'deduction_minutes',

        'updated_at','created_at'
    ];

    public function employee(){
        return $this->belongsTo('App\Employee', 'emp_id', 'employee_id');
    }
    public function branch(){
        return $this->belongsTo('App\Branch','branch_id','branch_id');
    }
    public function department(){
        return $this->belongsTo('App\Department','dept_id','department_id');
    }
    public function roster(){
        return $this->belongsTo('App\Roster','roster_id','id');
    }
    public function shift(){
        return $this->belongsTo('App\Shift','shift_code','shift_id');
    }
}
