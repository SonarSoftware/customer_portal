@include("layouts.partials.head")
<body class="inner_page">
    @include("layouts.partials.nav")
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    @if(count(getAvailableLanguages()) > 1)
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    @if(count(getAvailableLanguages()) > 1)
                        @include("layouts.partials.lang")
                    @endif
                </div>
            </div>
        </div>
    @endif
    @yield('content')
    @include('layouts.partials.js')
</body>
</html>