<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outward extends Model
{
    use HasFactory;
    public function  productVariantvalue()
    {
        return $this->hasMany(ProductVariantValue::class,'id','productVariantValueId');
    }
}
