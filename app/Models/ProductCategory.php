<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['name'];
    public function products() {
        return $this->hasMany(Product::class);
    }
}
