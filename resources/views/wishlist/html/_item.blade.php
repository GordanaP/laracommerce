<tr class="table-row">

    <!-- Image -->
    <td class="column-1">
        <div class="cart-img-product b-rad-4 o-f-hidden">
            <img src="{{ asset('vendor/fashe-colorlib/images/item-02.jpg') }}" alt="IMG-PRODUCT">
        </div>
    </td>

    <!-- Product details -->
    <td class="column-2">
        <p class="product-name">
            <a href="{{ route('products.show', $products->find($item->id)->slug) }}">
                {{ $products->find($item->id)->name }}
            </a>
        </p>
        <p class="text-xs mt-2">{{ $products->find($item->id)->description }}</p>
    </td>

    <!-- Price -->
    <td class="column-3">
        {{ $item->options->price }}
    </td>

    <!-- Actions -->
    <td class="column-4">
        @include('wishlist.forms._removeitem')

        <a href="{{ route('products.show', $products->find($item->id)->slug) }}">
            Add To Cart
        </a>
    </td>

</tr>