<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point')->notnull();
    }
}
