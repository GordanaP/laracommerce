<tr class="table-row">
    <td class="column-1">
        <form action="{{ route('carts.destroy', $item->rowId) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="btn-removecart-product">
                <button type="submit">
                    <span class="lnr lnr-trash text-red"></span>
                </button>
            </div>
        </form>

        <form action="{{ route('carts.switchtowishlist', $item->rowId) }}" method="POST">
            @csrf

            <div class="btn-removecart-product">
                <button type="submit">
                    <span class="lnr lnr-heart text-red"></span>
                </button>
            </div>
        </form>
    </td>
    <td class="column-2">
        <div class="cart-img-product b-rad-4 o-f-hidden">
            <img src="{{ asset('vendor/fashe-colorlib/images/item-02.jpg') }}" alt="IMG-PRODUCT">
        </div>
    </td>
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
    <td class="column-4">
        {{ config('app.currency') }}{{ number_format( $products->find($item->id)->price, 2 ) }}
    </td>
    <td class="column-5">
        <input type="text" class="border border-grey text-center w-12" style="padding-top: 7px !important; padding-bottom: 6px !important" name="quantity" id="quantity" value="{{ $item->qty }}"  data-id="{{ $item->rowId }}" />
        <button class="update-qty-btn">
            <i class="fa fa-refresh bg-black text-white px-2 py-2"></i>
        </button>
    </td>
    <td class="column-6s">{{ config('app.currency') }}
        {{ number_format($products->find($item->id)->price * $item->qty, 2) }}
    </td>
</tr>