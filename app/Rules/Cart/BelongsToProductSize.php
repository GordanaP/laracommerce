<?php

namespace App\Rules\Cart;

use Illuminate\Contracts\Validation\Rule;

class BelongsToProductSize implements Rule
{
    protected $product;

    protected $size_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product, $size_id)
    {
        $this->product = $product;

        $this->size_id = $size_id;
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
        $variant = $this->product->product_variants
            ->where('product_id', $this->product->id)
            ->where('size_id', $this->size_id)
            ->where('color_id', $value)
            ->first();

        return optional($variant)->exists;
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
