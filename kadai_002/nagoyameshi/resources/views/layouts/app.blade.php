@include('components.common.head')

<body>
    <div id="app">
    @include('components.common.header')

        <main class="py-4">
            @yield('content')
        </main>

        @include('components.common.footer')
    </div>
</body>
</html>
