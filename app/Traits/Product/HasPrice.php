<?php

namespace App\Traits\Product;

trait HasPrice
{
    /**
     * Get the product price.
     *
     * @param  int k $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        $price = $value == 0 ? $this->product->price : formattedPrice($value/100);

        return $price;
    }
}