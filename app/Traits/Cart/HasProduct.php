<?php

namespace App\Traits\Cart;

use App\Color;
use App\Product;
use App\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

trait HasProduct
{
    /**
     * Add a product to the cart.
     *
     * @param \App\Product  $product
     * @param string  $cart
     * @param array $data
     * @return  object
     */
    protected function addToCart($product, $cart, $data=null)
    {
        $size = $data['size_id'] ? Size::find($data['size_id']) : '';
        $color = $data['color_id'] ? Color::find($data['color_id']) : '';

        if ($data)
        {
            $item = Cart::instance($cart)->add($product, $data['quantity'], [
                'size_id' => $data['size_id'],
                'color_id' => $data['color_id'],
                'size' => $size ? $size->name : '',
                'color' => $color ? $color->name : '',
            ]);
        }
        else
        {
            $item = Cart::instance($cart)->add($product, 1);
        }

        return $item;
    }

    /**
     * Update the default cart.
     *
     * @param  int $rowId
     * @param  int $quantity
     * @return void
     */
    protected function updateCart($rowId, $quantity)
    {
        Cart::update($rowId, $quantity);
    }

    /**
     * Get all cart items.
     *
     * @param  string $cart
     * @return array
     */
    protected function getCartContent($cart=NULL)
    {
        return Cart::instance($cart)->content();
    }

    /**
     * Get a specific cart item.
     *
     * @param  int $rowId
     * @param  string $cart
     * @return object;
     */
    protected function getCartItem($rowId, $cart=NULL)
    {
        return Cart::instance($cart)->get($rowId);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int $rowId
     * @param  string $cart
     * @return void
     */
    protected function removeFromCart($rowId, $cart=NULL)
    {
        Cart::instance($cart)->remove($rowId);
    }

    /**
     * Remove all items from the cart.
     *
     * @param  string $cart
     * @return void
     */
    protected function emptyCart($cart=NULL)
    {
        Cart::instance($cart)->destroy();
    }

    /**
     * Add an item to and remove it from the wishlist.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return void
     */
    protected function toggleWishList($product, $cart)
    {
        if( $this->itemIsNotInTheCart($product, $cart) && $this->itemIsNotInTheCart($product, 'default'))
        {
            $this->addToCart($product, $cart);
        }
        else if($this->itemIsInTheCart($product, $cart))
        {
            $rowId = $this->findCartItemId($product, $cart);

            $this->removeFromCart($rowId, $cart);
        }
    }

    /**
     * Move an item from the default cart to another cart.
     *
     * @param  int $rowId
     * @param  string $cart
     * @return void
     */
    protected function switchToCart($rowId, $cart)
    {
        $product = $this->findProduct($rowId);

        $this->addToCart($product, $cart);

        $this->removeFromCart($rowId);
    }

    /**
     * The default cart has duplicate products.
     *
     * @param  \App\Product $product
     * @return boolean
     */
    protected function cartHasDuplicates($product)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use($product) {
            return $cartItem->id === $product->id && $cartItem->options->size_id === request()->size_id && $cartItem->options->color_id === request()->color_id;
        });

        return $duplicates->isNotEmpty();
    }

    /**
     * A product is in the cart.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return boolean
     */
    protected function itemIsInTheCart($product, $cart)
    {
        $item = $this->findCartItem($product, $cart);

        return $item->isNotEmpty();
    }

    /**
     * A product is not in the cart.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return boolean
     */
    protected function itemIsNotInTheCart($product, $cart)
    {
        $item = $this->findCartItem($product, $cart);

        return $item->isEmpty();
    }

    /**
     * Get a cart item rowId.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @param  string $attribute
     * @return int
     */
    protected function findCartItemId($product, $cart, $attribute='rowId')
    {
        $item = $this->findCartItem($product, $cart)->toArray();

        $values = array_values($item);

        $rowId = $values[0][$attribute];

        return $rowId;
    }

    /**
     * Find a cart item by a product id.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return object
     */
    protected function findCartItem($product, $cart)
    {
        $item = Cart::instance($cart)->search(function ($cartItem, $rowId) use($product) {
            return $cartItem->id === $product->id;
        });

        return $item;
    }

    /**
     * Find a product by a cart item rowId;
     *
     * @param  int $rowId
     * @return \App\Product
     */
    protected function findProduct($rowId)
    {
        $item = $this->getCartItem($rowId);

        $product = Product::find($item->id);

        return $product;
    }

    /**
     * Find products by cart items ids.
     *
     * @param  collection $cartItems
     * @return array
     */
    protected function findProducts($cartItems)
    {
        $ids = $cartItems->pluck('id');

        $products = Product::findMany($ids);

        return $products;
    }
}