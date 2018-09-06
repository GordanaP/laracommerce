<div class="leftbar p-r-20 p-r-0-sm">

    @if (collect(Request::query())->intersectByKeys($mappings)->all())
        <a href="{{ route('products.index') }}">
            Clear all filters
        </a>
    @endif

    @foreach ($mappings as $filter => $map)
        <h4 class="m-text14 p-b-7">
            {{ ucfirst($filter) }}

            @if (Request::has($filter))
                <a href="{{ route('products.index', removeQueryString($filter)) }}">
                    &times; Clear the filter
                </a>
            @endif
        </h4>

        <ul class="p-b-54">
            @foreach ($map as $name => $slug)
                <li class="p-t-4">
                    <a href="{{ route('products.index', getQueryString([$filter => $slug])) }}" class="s-text13 {{ getActiveClass(request($filter), $slug) }}" >
                        {{ ucfirst($name) }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach

</div>