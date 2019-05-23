<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'logo', 'website'
    ];

    /**
     * get company employees
     *
     * @return response
     */
    public function employees() {
        return $this->hasMany('App\Models\Employee', 'company_id', 'id');
    }
}
