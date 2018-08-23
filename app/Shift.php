<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table ='shifts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_id','name',  'company_id',
        'start_time', 'end_time',
        'grace_late','grace_early',
        'updated_at','created_at'
    ];
    public function rosters(){
        return $this->hasMany('App\Roster', 'shift_id','shift_id');
    }
}
