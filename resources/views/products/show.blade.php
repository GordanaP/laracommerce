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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.block2-btn-addcart').each(function(){
        //     var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to cart !", "success");
        //     });
        // });

        // $('.block2-btn-addwishlist').each(function(){
        //     var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to wishlist !", "success");
        //     });
        // });

        // $('.btn-addcart-product-detail').each(function(){
        //     var nameProduct = $('.product-detail-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to wishlist !", "success");
        //     });
        // });

        var showProductUrl ="{{ route('products.show', $product) }}";
        var indexColorsUrl = "{{ route('colors.index') }}";

        $('select#size_id').on('change', function () {

            var size_id = this.value;
            var colors_ids = [];

            $.ajax({
                url: showProductUrl,
                type: "GET",
                dataType: "json",
                async: false,
                success: function(response)
                {
                    var variants = response.product.product_variants;

                    $.each(variants, function(index, variant) {
                         if (size_id == variant.size_id) {
                              colors_ids.push(variant.color_id);
                         }
                    });
                }
            });

            $.ajax({
                url: indexColorsUrl,
                type: "POST",
                data: {
                    colors_ids : colors_ids
                },
                success: function(response)
                {
                    $('select#color_id').html(response.view)
                }
            });
        });

    </script>
@endsection
