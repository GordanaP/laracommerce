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

        var showProductUrl ="{{ route('products.show', $product) }}";

        function getOptions(values)
        {
           var html = '';

           $.each(values, function(index, value) {
              html += '<option value="'+ value.id +'">'+ value.name+'</option>'
           });

           return html;
        }

        $('select#size_id').on('change', function () {

            var size_id = this.value;
            var colors_ids = [];
            var options;
            var html = '';

            $.ajax({
                url: showProductUrl,
                type: "GET",
                success: function(response)
                {
                    console.log(response)
                    var sizes = response.product.sizes;

                    $.each(sizes, function(index, size) {

                        if (size.id == size_id) {
                             colors_ids.push(size.feature.color_id);
                        }
                    });

                    var indexColorsUrl = "{{ route('colors.index') }}";

                    var data = {
                        colors_ids : colors_ids
                    }

                    $.ajax({
                        url: indexColorsUrl,
                        type: "POST",
                        data: data,
                        success: function(response)
                        {
                            $.each(response.colors, function(index, color)
                            {
                                 html += '<option value="'+ color.id +'">'+ color.name +'</option>';
                            });

                            var placeholder = '<option>Choose a color</option>';
                            $('select#color_id').empty().append(placeholder).append(html);
                        }
                    });
                }
            });
        });
    </script>
@endsection
