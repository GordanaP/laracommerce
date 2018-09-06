<?php

namespace App\Traits\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;

trait HasProduct
{
    /**
     * The cart has no duplicate products.
     *
     * @param  string $cartName
     * @param  \App\Product $product
     * @return boolean
     */
    protected function cartHasNoDuplicates($product, $cartName=NULL)
    {
        if($cartName)
        {
            $duplicates = Cart::instance($cartName)->search(function ($cartItem, $rowId) use($product) {
                return $cartItem->id === $product->id;
            });
        }
        else
        {
            $duplicates = Cart::search(function ($cartItem, $rowId) use($product) {
                return $cartItem->id === $product->id;
            });
        }

        return $duplicates->isEmpty();
    }

    /**
     * Item is not in any cart.
     *
     * @param  \App\Product $product
     * @param  string $cartName
     * @return boolean
     */
    protected function itemIsNotInTheCart($product, $cartName)
    {
        return $this->cartHasNoDuplicates($product) && $this->cartHasNoDuplicates($product, $cartName);
    }

    /**
     * Add the product to the cart
     *
     * @param string  $cartName
     * @param \App\Product  $product
     * @param integer $quantity
     * @return  void
     */
    protected function addToCart($product, $cartName=NULL, $quantity = 1)
    {
        Cart::instance($cartName)->add($product, $quantity);
    }

    /**
     * Remove the product from the cart
     *
     * @param  string $cartName
     * @param  int $rowId
     * @return void
     */
    protected function removeFromCart($rowId, $cartName=NULL)
    {
        Cart::instance($cartName)->remove($rowId);
    }

    /**
     * Get all the products in the cart.
     *
     * @param  string $cartName
     * @return array
     */
    protected function getCartContent($cartName=NULL)
    {
        return Cart::instance($cartName)->content();
    }

    /**
     * Get a specific item from the cart.
     *
     * @param  string $cartName
     * @return array;
     */
    protected function getCartItem($rowId, $cartName=NULL)
    {
        return Cart::instance($cartName)->get($rowId);
    }

    /**
     * Rempve all items from the cart.
     *
     * @param  string $cartName
     * @return void
     */
    protected function emptyCart($cartName=NULL)
    {
        Cart::instance($cartName)->destroy();
    }
}