@extends('layouts.app')

@section('title', 'My Cart')

@section('content')

    <!-- Page Title-->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading.jpg);">
        <h2 class="l-text2 t-center">
            Cart
        </h2>
    </section>

    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">

            @if (Cart::count())
                <div class="container-table-cart pos-relative">
                    <div class="wrap-table-shopping-cart bgwhite">
                        <table class="table-shopping-cart">

                            <tr class="table-head">
                                <th class="column-1"></th>
                                <th class="column-2">Image</th>
                                <th class="column-3">Product</th>
                                <th class="column-4">Price</th>
                                <th class="column-5">Quantity</th>
                                <th class="column-6 pr-5">Subtotal</th>
                            </tr>

                            @foreach ($cartItems as $item)
                                @include('carts.html._item', ['products' => $products])
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                    <div class="flex-w flex-m w-full-sm">
                        <div class="size11 bo4 m-r-10">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
                        </div>

                        <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                            <!-- Button -->
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Apply coupon
                            </button>
                        </div>
                    </div>

                    @include('carts.forms._empty')
                </div>

                <!-- Total -->
                <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                    <h5 class="m-text20 p-b-24">
                        Cart Totals
                    </h5>

                    <!-- Subtotal -->
                    <div class="flex-w flex-sb-m p-b-12">
                        <span class="s-text18 w-size19 w-full-sm">
                            Subtotal:
                        </span>

                        <span class="m-text21 w-size20 w-full-sm" id="subtotal">
                            {{ presentPrice(Cart::subtotal()) }}
                        </span>
                    </div>

                    <!-- Tax -->
                    <div class="flex-w flex-sb-m p-b-12">
                        <span class="s-text18 w-size19 w-full-sm">
                            Tax ({{ config('cart.tax').'%' }}):
                        </span>

                        <span class="m-text21 w-size20 w-full-sm">
                            {{ presentPrice(Cart::tax()) }}
                        </span>
                    </div>

                    <!--  -->
                    <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                        <span class="s-text18 w-size19 w-full-sm">
                            Shipping:
                        </span>

                        <div class="w-size20 w-full-sm">
                            <p class="s-text8 p-b-23">
                                There are no shipping methods available. Please double check your address, or contact us if you need any help.
                            </p>

                            <span class="s-text19">
                                Calculate Shipping
                            </span>

                            <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
                                <select class="selection-2" name="country">
                                    <option>Select a country...</option>
                                    <option>US</option>
                                    <option>UK</option>
                                    <option>Japan</option>
                                </select>
                            </div>

                            <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
                            </div>

                            <div class="size13 bo4 m-b-22">
                                <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
                            </div>

                            <div class="size14 trans-0-4 m-b-10">
                                <!-- Button -->
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Update Totals
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
                        <span class="m-text22 w-size19 w-full-sm">
                            Total:
                        </span>

                        <span class="m-text21 w-size20 w-full-sm">
                            {{ presentPrice(Cart::total()) }}
                        </span>
                    </div>

                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            @else

                Your cart is empty!

                <a href="{{ route('products.index') }}" class="btn btn-default ml-3 rounded-full py-2 px-4 bg-black text-white">
                    Continue shopping
                </a>

            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-removecart-product').each(function(){

            // var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            var nameProduct = $(this).parent().parent().parent().find('.product-name a').html();

            $(this).on('click', function(){
                swal(nameProduct, "is removed from cart !", "success");
            });
        });

        var qtys = $("input[name*=quantity]");

        $.each(qtys, function(index, el) {

            $(this).on('change', function() {

                var quantity = el.value;
                var rowid = el.getAttribute('data-id');
                var updateCartUrl = '/my-cart/' + rowid;

                $.ajax({
                    url: updateCartUrl,
                    type: "PUT",
                    data: {
                        quantity: quantity
                    },
                    success: function(response)
                    {
                        window.location.href = "{{ route('carts.show') }}"
                    },
                    error: function(response)
                    {
                        errorResponse(getJsonErrors(response))
                    }
                });
            });
        });

    </script>
@endsection