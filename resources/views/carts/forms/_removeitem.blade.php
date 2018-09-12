<form action="{{ route('carts.destroy', $item->rowId) }}" method="POST">

    @csrf
    @method('DELETE')

    <div class="btn-removecart-product">
        <button type="submit">
            <span class="lnr lnr-trash text-red"></span>
        </button>
    </div>

</form>
