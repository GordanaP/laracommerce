<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials/top/_head')
</head>

<body class="animsition">
    <div id="app">

        <nav>
            @include('partials/top/_nav')
        </nav>

        <section>
            @yield('slider')
        </section>

        <section>
            @yield('banner')
        </section>

        <main>
            @yield('content')
        </main>

    </div>

    @include('partials.bottom._footer')
    @include('partials.bottom._scripts')
</body>
</html>
