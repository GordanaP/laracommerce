<form action="{{ route('wishlist.store', $product) }}" method="POST">

    @csrf

    <button type="submit">
        <i class="fa {{ itemIsInCart($product->id, config('constants.wishcart')) ? 'fa-heart' : 'fa-heart-o' }}"></i>
    </button>

</form>