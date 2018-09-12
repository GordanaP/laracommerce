@extends('layouts.app')

@section('title', 'My WishList')

@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading.jpg);">
        <h2 class="l-text2 t-center">
            WishList
        </h2>
    </section>

    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">

            @if (Cart::instance(config('constants.wishcart'))->count())

                <div class="container-table-cart pos-relative">
                    <div class="wrap-table-shopping-cart bgwhite">
                        <table class="table-shopping-cart">

                            <tr class="table-head">
                                <th class="column-1">Image</th>
                                <th class="column-2">Product</th>
                                <th class="column-3">Price</th>
                                <th class="column-4"></th>
                            </tr>

                            @foreach ($wishListItems as $item)
                                @include('wishlist.html._item', ['products' => $products])
                            @endforeach

                        </table>
                    </div>
                </div>

                <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm pull-right" style="border: none">

                    @include('wishlist.forms._empty')
                </div>
            @else

                You have not added any items to your Wish List yet!

                <a href="{{ route('products.index') }}" class="btn btn-default ml-3 rounded-full py-2 px-4 bg-black text-white">
                    Shop now
                </a>

            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        $('.btn-removecart-product').each(function(){

            // var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            var nameProduct = $(this).parent().parent().parent().find('.product-name a').html();

            $(this).on('click', function(){
                swal(nameProduct, "is removed from from your Wish List !", "success");
            });
        });
    </script>
@endsection