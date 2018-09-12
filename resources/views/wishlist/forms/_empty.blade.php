<form action="{{ route('wishlist.empty') }}" method="POST">

    @csrf
    @method('DELETE')

    <div class="size10 trans-0-4 m-t-10 m-b-10">
        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
            Clear Wish LIst
        </button>
    </div>

</form>