<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table ='branches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id','name', 'website','contact','company_id',
         'country', 'state','city','street_address_1','street_address_2','postal_code',
         'lat','lng','VAT_number','PAN_number','registration_number','updated_at','created_at'
    ];

    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function department(){
        return $this->hasMany('App\Department', 'branch_id','branch_id');
    }
}
