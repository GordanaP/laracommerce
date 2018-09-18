<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /**
     * Get the products that own the size.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->as('feature')->withPivot('color_id');
    }

    /**
     * Get the product variants that the size belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
