<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    use HasFactory;
    public function inputs()
    {
        return $this->hasMany('App\Models\ReportInput')->orderBy('order','desc');
    }
    public function parent()
    {
        return $this->hasOne('App\Models\ReportSection');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\ReportSection');
    }
}
