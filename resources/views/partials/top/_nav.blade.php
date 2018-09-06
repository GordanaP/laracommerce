<!-- Header -->
<header class="header1">

    <!-- HEADER DESKTOP -->
    <div class="container-menu-header">

        <!-- Topbar -->
        @include('partials.top.desktop._topbar')

        <div class="wrap_header">

            <!-- Logo -->
            @include('partials.top.desktop._logo')


            <!-- Menu -->
            @include('partials.top.desktop._menu')


            <!-- Header Icon -->
            @include('partials.top.desktop._icons')
        </div>
    </div>

    <!-- HEADER MOBILE -->
    <div class="wrap_header_mobile">

        <!-- Logo moblie -->
        @include('partials.top.mobile._logo')


        <!-- Button show menu -->
        @include('partials.top.mobile._icons')


        <!-- Menu Mobile -->
        @include('partials.top.mobile._menu')

</header>