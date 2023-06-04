<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        
        'category_id',
        'subcategory_id',
        'product_name',
        'product_summary',
        'product_description',
        'product_price',
        'product_quantity',
        'product_thumbnail',
    ];
            
    
    function get_category(){
        
        return $this->belongsTo(Category::class ,'category_id');
    }
    function get_subcategory(){
        
        return $this->belongsTo(SubCategory::class ,'subcategory_id');
    }
}
