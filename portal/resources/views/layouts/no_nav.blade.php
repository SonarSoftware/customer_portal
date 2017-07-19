@include("layouts.partials.head")
<body>
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    @if(count(getAvailableLanguages()) > 1)
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
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