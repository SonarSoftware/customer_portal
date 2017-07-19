@include("layouts.partials.head")
<body>
    @include("layouts.partials.nav")
    @if(count(getAvailableLanguages()) > 1)
    @include("layouts.partials.lang")
    @endif
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    @yield('content')
    @include('layouts.partials.js')
</body>
</html>