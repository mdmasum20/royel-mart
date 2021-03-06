<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parent_id',
        'child_id',
        'name',
        'slug',
        'image',
        'category_color',
        'menu',
        'feature',
        'serial_number',
        'show_hide',
        'status',
    ];
}
