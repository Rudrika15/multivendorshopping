<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class,'id','productVariantId');
    }
    public function store()
    {
        return $this->belongsTo(Store::class,'storeId','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
