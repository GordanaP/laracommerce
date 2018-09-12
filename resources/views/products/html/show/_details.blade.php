<div class="w-size14 p-t-30 respon5">

    <!-- Name -->
    <h4 class="product-detail-name m-text16 p-b-13">
        {{ $product->name }}
    </h4>

    <!-- Price -->
    <span class="m-text17">
        {{ $product->present_price }}
    </span>

    <!-- Description -->
    <p class="s-text8 p-t-10">
        Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
    </p>

    @include('products.forms._addtocart')

    <!-- Categories -->
    <div class="p-b-45">
        <span class="s-text8 m-r-35">SKU: MUG-01</span>
        <span class="s-text8">
            Categories:
            @foreach ($product->categories->unique() as $category)
                {{ $category->name }}
            @endforeach
        </span>
    </div>

    <!-- Description -->
    <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
            Description
            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
            <p class="s-text8">
                {{ $product->description }}
            </p>
        </div>
    </div>

    <!-- Additional information -->
    <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
            Additional information
            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
            <p class="s-text8">
                Some additional information
            </p>
        </div>
    </div>

    <!-- Reviews -->
    <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
            Reviews (0)
            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
            <p class="s-text8">
                Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
            </p>
        </div>
    </div>
</div>