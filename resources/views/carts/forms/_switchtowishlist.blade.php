<form action="{{ route('carts.switchtowishlist', $item->rowId) }}" method="POST">

    @csrf

    <div class="btn-removecart-product">
        <button type="submit">
            <span class="lnr lnr-heart text-red"></span>
        </button>
    </div>

</form>