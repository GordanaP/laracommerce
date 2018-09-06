<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{
    /**
     * Listen to the Product creating event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = str_slug($product->name);
    }
}