@extends('layouts.app')

@section('content')

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

            var placeholder = '<option value="">Choose a color</option>';
            $('select#color_id').empty().append(placeholder).append(html);
        }
    });

    // CartController@store
            // if ($this->cartHasDuplicates($product))
        // {
        //     return redirect()->route('carts.show');
        // }
        // else
        // {
        //     $item = $this->addToCart($product, 'default', $request);

        //     if($this->itemIsInTheCart($item, config('constants.wishcart')))
        //     {
        //         $rowId = $this->findCartItemId($item, config('constants.wishcart'));

        //         $this->removeFromCart($rowId, config('constants.wishcart'));
        //     }

        //     return back();
        // }

@endsection