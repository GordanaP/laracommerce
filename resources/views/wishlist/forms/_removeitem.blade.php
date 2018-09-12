<form action="{{ route('wishlist.destroy', $item->rowId) }}" method="POST">

    @csrf
    @method('DELETE')

    <div class="btn-removecart-product">
        <button type="submit" class="text-red">
            Remove
        </button>
    </div>

</form>