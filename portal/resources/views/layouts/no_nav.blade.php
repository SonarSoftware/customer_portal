@include("layouts.partials.head")
<body>
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    @if(count(getAvailableLanguages()) > 1)
        @include("layouts.partials.lang")
    @endif
    @yield('content')
    @include('layouts.partials.js')
</body>
</html>