<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasMany(Product::class,'id','productId');
    }
    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class,'id','productVariantId');
    }
    public function store()
    {
        return $this->belongsTo(Store::class,'storeId','id');
    }
}
