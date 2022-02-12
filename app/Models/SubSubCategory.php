<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'image',
        'icon',
        'menu',
        'feature',
        'serial_number',
        'show_hide_status',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
