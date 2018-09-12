<?php

namespace App\Rules\Cart;

use Illuminate\Contracts\Validation\Rule;

class BelongsToProductSize implements Rule
{
    protected $product;

    protected $size;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product, $size)
    {
        $this->product = $product;

        $this->size = $size;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product_id = $this->product->id;
        $size_id = $this->size;

        $products = \App\Product::whereHas('sizes', function ($q) use ($product_id, $size_id, $value) {
            $q->where('product_id', $product_id)->where('size_id', $size_id)->where('color_id', $value);
        })->get();

        return sizeof($products) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value is invalid.';
    }
}
