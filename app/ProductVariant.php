<?php

namespace App;

use App\Traits\Product\HasPrice;
use App\Traits\Product\IsBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model implements Buyable
{
    use IsBuyable, HasPrice;

    /**
     * Get the product that owns the variant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the size that owns the variant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * Get the color that owns the variant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getNameAttribute()
    {
        return $this->name = $this->product->name;
    }
}
