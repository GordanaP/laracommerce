<?php

/**
 * An item is in the cart.
 *
 * @param  integer $itemId
 * @param  string $cart
 * @return boolean
 */
function itemIsInCart($itemId, $cart)
{
    $itemsIds = Cart::instance($cart)->content()->pluck('id')->toArray();

    return in_array($itemId, $itemsIds);
}

/**
 * Get quantity-related product subtotal.
 *
 * @param  float  $price
 * @param  integer  $quantity
 * @return float
 */
function getItemSubtotal($price, $quantity)
{
    $subtotal = $price * $quantity;

    return $subtotal;
}

/**
 * Get currency and formatted price.
 *
 * @param  float $price
 * @param  integer $decimals
 * @return string
 */
function presentPrice($price)
{
    $currency = config('app.currency');

    return $currency.$price;
}

/**
 * Get formatted price.
 *
 * @param  float  $price
 * @param  integer $decimals
 * @return float
 */
function getFormattedPrice($price, $decimals = 2)
{
    $price = number_format($price, $decimals);

    return $price;
}