<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Product;
use App\Traits\Cart\HasProduct;
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
        $cart = config('constants.wishcart');

        if($this->cartHasDuplicates($product, $request))
        {
            return redirect()->route('carts.show');
        }

        $this->addToCart($product, $request);

        if($this->itemIsInTheCustomCart($product, $cart)) {

            $rowId = $this->findCartItemId($product, $cart, $attribute='rowId');

            $this->removeFromCart($rowId, $cart);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cartItems = $this->getCartContent();

        $products = $this->findProducts($cartItems);

        return view('carts.show', compact('cartItems', 'products'));
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
     * @param  int  $rowId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $this->updateCart($rowId, $request->quantity);

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