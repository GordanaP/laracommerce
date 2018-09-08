<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\Cart\HasProduct;
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
        if($this->itemIsInTheCart($product, 'default'))
        {
            return redirect()->route('carts.show');
        }

        $this->toggleWishList($product, config('constants.wishcart'));

        return back();
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
