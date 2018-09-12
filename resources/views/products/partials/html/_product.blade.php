<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">

    <div class="block2">
        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">

            <img src="{{ asset('images/item-02.jpg') }}" alt="IMG-PRODUCT">

            <div class="block2-overlay trans-0-4">
                <div class="block2-btn-addcart w-size1">
                    <a href="{{ route('products.show', $product) }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" >
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>

        <div class="block2-txt p-t-20">
            <div class="flex justify-between">
                <a href="{{ route('products.show', $product) }}" class="block2-name dis-block s-text3 p-b-5">
                    {{ $product->name }}
                </a>

                @include('products.forms._togglewishlist')
            </div>

            <span class="block2-price m-text6 p-r-5">
                {{ $product->present_price }}
            </span>
        </div>
    </div>

</div>