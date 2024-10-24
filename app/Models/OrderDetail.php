<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(OrderMaster::class,'orderMasterId','id');
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariantValue::class,'productVariantValueId','id');
    }
}
