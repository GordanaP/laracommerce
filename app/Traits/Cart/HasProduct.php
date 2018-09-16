<?php

namespace App\Traits\Cart;

use App\Color;
use App\Product;
use App\ProductVariant;
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
    // protected function addToCart($product, $cart, $data=null)
    // {
    //     $size = $data['size_id'] ? Size::find($data['size_id']) : '';
    //     $color = $data['color_id'] ? Color::find($data['color_id']) : '';

    //     if ($data)
    //     {
    //         $item = Cart::instance($cart)->add($product, $data['quantity'], [
    //             'size_id' => $size ? $data['size_id'] : '',
    //             'size' => $size ? $size->name : '',
    //             'color_id' => $color ? $data['color_id'] : '',
    //             'color' => $color ? $color->name : '',
    //         ]);
    //     }
    //     else
    //     {
    //         $item = Cart::instance($cart)->add($product, 1);
    //     }

    //     return $item;
    // }

    // protected function addToCart($product, $quantity = 1)
    // {
    //     if($product->hasVariants())
    //     {
    //         $item = Cart::add($product->getVariant(), $quantity);
    //     }
    //     else
    //     {
    //         $item = Cart::add($product->getVariant(), $quantity);
    //     }

    //     return $item;
    // }
    //
    //

    /**
     * Add an item to the cart.
     *
     * @param \App\Product $product
     * @param array $data
     */
    protected function addToCart($product, $data)
    {
        $variant = $product->findVariant($data);
        $quantity = $data['quantity'] ?: 1;
        $size = $data['size_id'] ? Size::find($data['size_id'])->name : '';
        $color = $data['color_id'] ? Color::find($data['color_id'])->name : '';

        $variant ?  Cart::add($variant, $quantity, [
                        'id'=>$variant->product->id,
                        'size' => $size,
                        'color' => $color,
                    ])
                :   Cart::add($product, $quantity, ['id' => $product->id]);
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
    // protected function cartHasDuplicates($product)
    // {
    //     if(request()->size_id && request()->color_id)
    //     {
    //         $duplicates = Cart::search(function ($cartItem, $rowId) use($product) {
    //             return $cartItem->id === $product->id && $cartItem->options->size_id === request()->size_id && $cartItem->options->color_id === request()->color_id;
    //         });
    //     }
    //     else
    //     {
    //         $duplicates = Cart::search(function ($cartItem, $rowId) use($product) {
    //             return $cartItem->id === $product->id;
    //         });
    //     }

    //     return $duplicates->isNotEmpty();
    // }

    protected function cartHasDuplicates($product)
    {
        if($product->hasVariants())
        {
            foreach ($product->product_variants as $productVariant)
            {
                $duplicates = \Cart::search(function ($cartItem, $rowId) use($productVariant) {
                    return $cartItem->id === $productVariant->id;
                });
            }
        }
        else
        {
            $duplicates = \Cart::search(function ($cartItem, $rowId) use($product) {
                    return $cartItem->id === $product->id;
                });
        }

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
        $ids = $cartItems->pluck('options.id');

        $products = Product::findMany($ids);

        return $products;
    }

}