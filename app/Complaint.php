<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
            'account_number',
            'zone',
            'phone',
            'complaint_type',
            'report_medium',
            'complaint_priority',
    ];

    public function technician(){
        return $this->hasOne(Technician::class);
    }
}
