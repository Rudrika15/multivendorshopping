<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public function productVariantValue()
     {
       return $this->belongsTo(ProductVariantValue::class,'productVariantValueId','id');
    }
}
