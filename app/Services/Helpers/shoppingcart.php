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
function itemSubtotal($price, $quantity)
{
    $subtotal = $price * $quantity;

    return $subtotal;
}

/**
 * Present the price and the currency.
 *
 * @param  float $price
 * @return string
 */
function presentPrice($price)
{
    return presentCurrency() . formattedPrice($price);
}

/**
 * Get formatted price.
 *
 * @param  float  $price
 * @param  integer $decimals
 * @return float
 */
function formattedPrice($price, $decimals = 2)
{
    $price = number_format($price, $decimals);

    return $price;
}

/**
 * Get the currency;
 *
 * @return string
 */
function presentCurrency()
{
    return config('app.currency');
}