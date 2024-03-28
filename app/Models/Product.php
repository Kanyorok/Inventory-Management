<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name', 'description', 'product_category_id', 'price', 'stock', 'stock_defective'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id')->withTrashed();
    }

    public function solds()
    {
        return $this->hasMany(SoldProduct::class);
    }

    public function receiveds()
    {
        return $this->hasMany(ReceivedProduct::class);
    }
}