var showProductUrl ="{{ route('products.show', $product) }}";
var indexColorsUrl = "{{ route('colors.index') }}";
var selectSize = $('select#size_id');
var selectColor = $('select#color_id');

selectSize.on('change', function () {

    var size_id = this.value;
    var colors_ids = [];

    $.ajax({
        url: showProductUrl,
        type: "GET",
        dataType: "json",
        async: false,
        success: function(response)
        {
            var variants = response.product.product_variants;

            $.each(variants, function(index, variant) {
                 if (size_id == variant.size_id) {
                      colors_ids.push(variant.color_id);
                 }
            });
        }
    });

    $.ajax({
        url: indexColorsUrl,
        type: "POST",
        data: {
            colors_ids : colors_ids
        },
        success: function(response)
        {
            selectColor.html(response.view)
        }
    });
});
