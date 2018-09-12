<tr class="table-row">

    <!-- Actions -->
    <td class="column-1">
        @include('carts.forms._removeitem')
        @include('carts.forms._switchtowishlist')
    </td>

    <!-- Image -->
    <td class="column-2">
        <div class="cart-img-product b-rad-4 o-f-hidden">
            <img src="{{ asset('vendor/fashe-colorlib/images/item-02.jpg') }}" alt="IMG-PRODUCT">
        </div>
    </td>

    <!-- Product name, desciption, size, color -->
    <td class="column-3">
        <p class="product-name">
            <a href="{{ route('products.show', $products->find($item->id)->slug) }}">
                {{ $products->find($item->id)->name }}
            </a>
        </p>
        <p class="text-xs mt-2">{{ $products->find($item->id)->description }}</p>
        <p class="text-xs mt-2">Size: {{  $item->options->size ?: 'No size' }} </p>
        <p class="text-xs mt-2">Color: {{ $item->options->color ?: 'No color'}} </p>
    </td>

    <!-- Price -->
    <td class="column-4">
        {{ presentPrice($products->find($item->id)->price) }}
    </td>

    <!-- Update Qty -->
    <td class="column-5">
        <input type="text" class="border border-grey text-center w-12 pt-2 pb-2" name="quantity" id="quantity" value="{{ $item->qty }}" data-id="{{ $item->rowId }}" />

        <button class="update-qty-btn">
            <i class="fa fa-refresh bg-black text-white text-xl px-2 py-2"></i>
        </button>
    </td>

    <!-- Product subtotal -->
    <td class="column-6s">
        {{ presentPrice(getFormattedPrice(getItemSubtotal($products->find($item->id)->price, $item->qty)))   }}
    </td>

</tr>