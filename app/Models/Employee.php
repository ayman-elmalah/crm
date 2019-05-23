<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];

    /**
     * get company data
     *
     * @return response
     */
    public function company() {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }
}
