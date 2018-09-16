<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * Get the product variants that the color belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
