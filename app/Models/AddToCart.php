<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class, 'id', 'productVariantValueId');
    }
}
