<?php

namespace App;

use App\Traits\ProductVariant\IsBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model implements Buyable
{
    use IsBuyable;

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

    /**
     * Set the variant price.
     *
     * @param  int  $value
     * @return float
     */
    public function getPriceAttribute($value, $decimals = 2)
    {
        $price = $value/100;

        $price_formatted = number_format($price, $decimals);

        return $price_formatted;
    }
}
