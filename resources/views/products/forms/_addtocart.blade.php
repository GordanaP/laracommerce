<form action="{{ route('carts.store', $product) }}" method="POST">

    @csrf

    <!-- Size -->
    @if ($product->hasSizes())
        <div class="p-t-33 p-b-60">
            <div class="flex-m flex-w p-b-10">
                <div class="s-text15 w-size15 t-center">
                    Size
                </div>

                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                    <select class="selection-2" name="size_id" id="size_id">
                        <option value="">Choose a size</option>
                        @foreach ($product->getSizes() as $size)
                            <option value="{{ $size->id }}"
                               {{  getSelected($size->id , old('size_id')) }}
                            >
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex-m flex-w p-b-10">
                <div class="s-text15 w-size15 t-center"></div>

                <div>
                    @if ($errors->has('size_id'))
                        <span class="invalid-feedback m-r-22" role="alert">
                            <strong>{{ $errors->first('size_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
         @endif

        <!-- Color -->
        @if ($product->hasColors())
            <div class="flex-m flex-w">
                <div class="s-text15 w-size15 t-center">
                    Color
                </div>

                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                    <select class="selection-2" name="color_id" id="color_id">

                        <option value="">Choose a color</option>

                        @if ($product->hasSizes())

                            <!-- Append size-related colors -->

                        @else
                            @foreach ($product->getColors() as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        @endif

                    </select>
                </div>
            </div>
            <div class="flex-m flex-w p-b-10">
                <div class="s-text15 w-size15 t-center"></div>

                <div>
                    @if ($errors->has('color_id'))
                        <span class="invalid-feedback m-r-22" role="alert">
                            <strong>{{ $errors->first('color_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="flex-r-m flex-w p-t-10">
            <div class="w-size16 flex-m flex-w">

                <!-- Quantity -->
                <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                    </button>

                    <input class="size8 m-text18 t-center num-product" type="number" name="quantity" id="quantity" value="{{ old('quantity') ?: 1 }}" />


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

        <div class="flex-m flex-w p-b-10">
            <div class="s-text15 w-size15 t-center"></div>

            <div>
                @if ($errors->has('quantity'))
                    <span class="invalid-feedback m-r-22" role="alert">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

</form>
