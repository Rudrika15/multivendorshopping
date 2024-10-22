<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productGallery extends Model
{
    use HasFactory;
    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'productVariantValueId');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'productId');
    }
}
