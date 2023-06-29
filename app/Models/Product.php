<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'slug',
        'description',
        'stock',
        'price'
    ];
    protected $keyType = 'string';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_asset()
    {
        return $this->hasMany(Product_asset::class);
    }
}
