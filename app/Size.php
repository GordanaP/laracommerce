<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->as('feature')->withPivot('color_id');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
