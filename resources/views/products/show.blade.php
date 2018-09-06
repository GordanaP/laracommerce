@extends('layouts.app')

@section('title', 'Product')

@section('content')

    <!-- Breadcrumb -->
    @include('products.partials.html._breadcrumb')

    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">

            <!-- Images -->
            @include('products.html.show._images')

            <!-- Details -->
            @include('products.html.show._details')

        </div>
    </div>

    <!-- Relate Products -->
    @include('products.partials.html._relatedproducts')

@endsection

@section('scripts')
    <script>
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });

        $('.btn-addcart-product-detail').each(function(){
            var nameProduct = $('.product-detail-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>
@endsection