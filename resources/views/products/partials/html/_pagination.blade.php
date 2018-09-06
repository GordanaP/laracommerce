<div class="pagination flex-m flex-w p-t-26 pull-right">

    {{ $products->appends(Request::query())->links() }}
    {{-- <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
    <a href="#" class="item-pagination flex-c-m trans-0-4">2</a> --}}
</div>