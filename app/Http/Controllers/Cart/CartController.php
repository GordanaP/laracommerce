<?php

namespace App\Http\Controllers\Cart;

use App\Color;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use App\Traits\Cart\HasProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use HasProduct;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        if($this->itemIsNotInTheCart($product, config('constants.wishcart')))
        {
            $size = Size::find($request->size_id);
            $color = Color::find($request->color_id);

            Cart::instance('default')->add($product, $request->quantity, [
                'size_id' => $size->id,
                'color_id' => $color->id,
            ]);

            return back();
        }

        return redirect()->route('carts.show');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        $cartItems = $this->getCartContent();

        return view('carts.show', compact('cartItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        Cart::update($rowId, $request->quantity);

        return response([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $rowId
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        $this->removeFromCart($rowId);

        return back();
    }

    /**
     * Move the product from the cart to the wish list.
     *
     * @param int $rowId
     * @return  \Illuminate\Http\Response
     */
    public function switchToWishList($rowId)
    {
        $item = $this->getCartItem($rowId);
        $product = Product::find($item->id);
        $this->removeFromCart($rowId);

        if($this->addToCart($product, config('constants.wishcart')) )
        {
            return back();
        }

        return redirect()->route('wishlist.show');
    }

    /**
     * Empty cart.
     *
     * @return  \Illuminate\Http\Response
     */
    public function empty()
    {
        $this->emptyCart();

        return back();
    }
}