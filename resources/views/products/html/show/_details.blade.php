<div class="w-size14 p-t-30 respon5">

    <!-- Name -->
    <h4 class="product-detail-name m-text16 p-b-13">
        {{ $product->name }}
    </h4>

    <!-- Price -->
    <span class="m-text17">
        {{ $product->present_price }}
    </span>

    <p class="s-text8 p-t-10">
        Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
    </p>

    <form action="{{ route('carts.store', $product) }}" method="POST">

        @csrf

        <div class="p-t-33 p-b-60">

            <!-- Size -->
            <div class="flex-m flex-w p-b-10">
                <div class="s-text15 w-size15 t-center">
                    Size
                </div>

                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                    <select class="selection-2" name="size_id" id="size_id">
                        <option>Choose a size</option>
                        @foreach ($product->sizes->unique() as $size)
                            <option value="{{ $size->id}}">
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Color -->
            <div class="flex-m flex-w">
                <div class="s-text15 w-size15 t-center">
                    Color
                </div>

                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                    <select class="selection-2" name="color_id" id="color_id">

                        <option>Choose a color</option>

                        <!-- Append size-related colors -->

                    </select>
                </div>
            </div>

            <div class="flex-r-m flex-w p-t-10">
                <div class="w-size16 flex-m flex-w">

                    <!-- Quantity -->
                    <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                        </button>

                        <input class="size8 m-text18 t-center num-product" type="number" name="quantity" id="quantity" value="1">

                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>

                    <!-- Button -->
                    <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                        <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
                Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
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