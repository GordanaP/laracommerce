<?php

namespace App\Traits\Cart;

use App\Color;
use App\Product;
use App\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

trait HasProduct
{
    /**
     * Add an item to a default cart.
     *
     * @param \App\Product $product
     * @param array $data
     * @return  void
     */
    protected function addToCart($product, $data)
    {
        $variant = $product->findVariant($data);
        $quantity = $data['quantity'] ?: 1;
        $size = $data['size_id'] ? Size::find($data['size_id'])->name : '';
        $color = $data['color_id'] ? Color::find($data['color_id'])->name : '';

        // Add to cart a product or its variant
        $variant ?  Cart::add($variant, $quantity, [
                        'type' => 'variant',
                        'product_id'=>$variant->product->id,
                        'size' => $size,
                        'color' => $color,
                    ])
                 :  Cart::add($product, $quantity, [
                        'type' => 'product',
                        'product_id' => $product->id
                    ]);
    }

    /**
     * Update the default cart.
     *
     * @param  string $rowId
     * @param  integer $quantity
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
     * @param  string $rowId
     * @param  string $cart
     * @return array;
     */
    protected function getCartItem($rowId, $cart=NULL)
    {
        return Cart::instance($cart)->get($rowId);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  string $rowId
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
        if( $this->itemIsNotInTheCart($product, $cart))
        {
            Cart::instance($cart)->add($product, 1, [
                'product_id' => $product->id,
                'price' => $product->present_price,
            ]);
        }
        else if($this->itemIsInTheCustomCart($product, $cart))
        {
            $rowId = $this->findCartItemRowId($product, $cart);

            $this->removeFromCart($rowId, $cart);
        }
    }

    /**
     * A product is not in any cart.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return boolean
     */
    protected function itemIsNotInTheCart($product, $cart)
    {
        $cartItem = $this->findCartItem($product);

        $customCartItem = $this->findCartItem($product, $cart);

        return $cartItem->isEmpty() && $customCartItem->isEmpty();
    }

    /**
     * Am item is in the custom cart.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return boolean
     */
    protected function itemIsInTheCustomCart($product, $cart)
    {
        return $this->findCartItem($product, $cart)->isNotEmpty();
    }

    /**
     * Find a cart item by a product id.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return array
     */
    protected function findCartItem($product, $cart = null)
    {
        $item = Cart::instance($cart)->search(function ($cartItem, $rowId) use($product) {
                return $cartItem->options->product_id === $product->id;
            });

        return $item;
    }

    /**
     * Get a cart item rowId.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @param  string $attribute
     * @return int
     */
    protected function findCartItemRowId($product, $cart, $attribute='rowId')
    {
        $item = $this->findCartItem($product, $cart)->toArray();

        $values = array_values($item);

        $rowId = $values[0][$attribute];

        return $rowId;
    }

    /**
     * Find a product by a cart item rowId;
     *
     * @param  string $rowId
     * @return \App\Product
     */
    protected function findProduct($rowId)
    {
        $item = $this->getCartItem($rowId);

        $product = Product::find($item->id);

        return $product;
    }

    /**
     * Find products by cart items options product_id.
     *
     * @param  collection $cartItems
     * @return array
     */
    protected function findProducts($cartItems, $cart = null)
    {
        $products_ids = $cart ? $cartItems->pluck('id') : $cartItems->pluck('options.product_id');

        $products = Product::findMany($products_ids);

        return $products;
    }

    /**
     * The default cart has duplicates.
     *
     * @param  \App\Product $product
     * @param  array $data
     * @return boolean
     */
    protected function cartHasDuplicates($product, $data)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product, $data) {

            $variant = $product->findVariant($data);

            return $variant ? ($cartItem->id === $variant->id && $this->isCartItemType($cartItem, 'variant'))
                            : ($cartItem->id === $product->id && $this->isCartItemType($cartItem, 'product'));
        });

        return $duplicates->isNotEmpty();
    }

    /**
     * Determine whether the cart item is a product or its variant.
     *
     * @param  array $cartItem
     * @param  string $type
     * @return boolean
     */
    protected function isCartItemType($cartItem, $type)
    {
        return $cartItem->options->type === $type;
    }

    /**
     * Remove the item from the custom cart.
     *
     * @param  \App\Product $product
     * @param  string $cart
     * @return void
     */
    protected function removeFromTheCustomCart($product, $cart)
    {
        if($this->itemIsInTheCustomCart($product, $cart)) {

            $rowId = $this->findCartItemRowId($product, $cart);

            $this->removeFromCart($rowId, $cart);
        }
    }
}