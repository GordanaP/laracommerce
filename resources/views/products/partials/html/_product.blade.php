<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">

    <div class="block2">
        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">

            <img src="{{ asset('images/item-02.jpg') }}" alt="IMG-PRODUCT">

            <div class="block2-overlay trans-0-4">
                {{-- <div class="block2-btn-addwishlist hov-pointer trans-0-4">
                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                </div> --}}
                <div class="block2-btn-addwishlist hov-pointer trans-0-4">
                    <form action="{{ route('wishlist.store', $product) }}" method="POST">
                        @csrf
                        <button type="submit" style="display: inline;">
                           <i class="fa fa-heart-o"></i>
                        </button>
                    </form>
                </div>

                <div class="block2-btn-addcart w-size1">
                    <form action="{{ route('carts.store', $product) }}" method="POST">
                        @csrf
                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="block2-txt p-t-20">

            <div style="display:flex; justify-content: space-between;">
                <a href="{{ route('products.show', $product) }}" class="block2-name dis-block s-text3 p-b-5">
                    {{ $product->name }}
                </a>
                <form action="{{ route('wishlist.store', $product) }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="fa {{ itemIsInCart($product->id, config('constants.wishcart')) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                    </button>
                </form>
            </div>

            <span class="block2-price m-text6 p-r-5">
                {{ $product->presentPrice }}
            </span>
        </div>
    </div>
</div>