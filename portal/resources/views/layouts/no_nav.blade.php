@include("layouts.partials.head")
<body>
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    @yield('content')
    @include('layouts.partials.js')
</body>
</html>