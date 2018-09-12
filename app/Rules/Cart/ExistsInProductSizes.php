<?php

namespace App\Rules\Cart;

use Illuminate\Contracts\Validation\Rule;

class ExistsInProductSizes implements Rule
{
    protected $product;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
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
        $sizes = $this->product->sizes->unique()->pluck('id');

        return $sizes->contains($value);
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
