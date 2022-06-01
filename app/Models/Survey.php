<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $casts = [
        'check_lists' => 'array',
        // 'electric_system_description' => 'array',
        'survey_validation' => 'array',
        'equipment_inventory' => 'array',
        'visit_validation' => 'array',
        'single_diagram' => 'array',
        'equipment_inventory_2' => 'array',
    ];
    use HasFactory;
}
