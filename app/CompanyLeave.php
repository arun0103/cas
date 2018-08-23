<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyLeave extends Model
{
    protected $table ='company_leave';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','branch_id', 'leave_id',
        'updated_at','created_at'
    ];

    public function leaveMaster(){
        return $this->belongsTo('App\LeaveMaster','leave_id','leave_id');
    }
}
