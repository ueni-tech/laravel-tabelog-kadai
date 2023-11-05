@include('components.common.head')

<body>
  <div id="app">
    @include('components.dashboard.header')
    <div class="row">
      <div class="col-3 mt-3">
        @include('components.dashboard.sidebar')
      </div>
      <div class="col">
        <main class="py-4 mb-5">
          @yield('content')
        </main>
      </div>
    </div>
  </div>
</body>

</html>