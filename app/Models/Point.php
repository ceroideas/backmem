<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $casts = [
    	'services' => 'array',
        'measuring' => 'array'
    ];
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function survey()
    {
        return $this->hasOne('App\Models\Survey');
    }

    public function getServiceValue($name)
    {
        if (!$this->services) {
            return "";
        }
        $services = json_decode($this->services,true);

        foreach ($services as $key => $value) {
            if ($value['key'] == $name) {
                return $value['value'];
            }
        }

        return "";
    }
    public function getProcessValue($name)
    {
        if (!$this->processes) {
            return "";
        }
        $processes = json_decode($this->processes,true);

        foreach ($processes as $key => $value) {
            if ($value['key'] == $name) {
                return $value['value'];
            }
        }

        return "";
    }

    public function scopeNotnull($q)
    {
        $q->whereNotNull('street')->whereNotNull('entity');
    }
}
