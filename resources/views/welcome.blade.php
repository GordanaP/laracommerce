@extends('layouts.app')

@section('title', 'Home')

@section('banner')
    @include('partials.main._slider')
@endsection

@section('content')

    <!-- Banner 1 -->
    @include('partials.main._banner1')

    <!-- New Product -->
    @include('partials.main._newproduct')

    <!-- Banner2 -->
    @include('partials.main._banner2')

    <!-- Blog -->
    @include('partials.main._blog')

    <!-- Shipping -->
    @include('partials.main._shipping')

@endsection

@section('scripts')
    <script src="{{ asset('vendor/fashe-colorlib/vendor/noui/nouislider.min.js') }}"></script>

    <script>

        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });

    </script>
@endsection