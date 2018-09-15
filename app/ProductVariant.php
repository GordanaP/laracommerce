<?php

namespace App;

use App\Traits\ProductVariant\IsBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model implements Buyable
{
    use IsBuyable;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
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

    public static function findBy($product, $data)
    {
        $variant = static::where([
            'product_id' => $product->id,
            'size_id' => $data['size_id'],
            'color_id' => $data['color_id'],
        ])->first();

        return $variant;
    }
}
