<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\Cart\HasProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    use HasProduct;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $wishListItems = $this->getCartContent(config('constants.wishcart'));

        return view('wishlist.show', compact('wishListItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product $product
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        if( $this->itemIsNotInTheCart($product, config('constants.wishcart') ) )
        {
            $this->addToCart($product, config('constants.wishcart'));

            return back();
        }

        return redirect()->route('wishlist.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $rowId
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        $this->removeFromCart($rowId, config('constants.wishcart'));

        return back();
    }

    /**
     * Move a product from a wish list to a cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $rowId
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($rowId)
    {
        $item = $this->getCartItem($rowId, config('constants.wishcart'));

        $product = Product::find($item->id);

        $this->removeFromCart($rowId, config('constants.wishcart'));

        if($this->addToCart($product))
        {
            return back();
        }

        return redirect()->route('carts.show');
    }

    /**
     * Empty cart.
     *
     * @return  \Illuminate\Http\Response
     */
    public function empty()
    {
        $this->emptyCart(config('constants.wishcart'));

        return back();
    }
}
