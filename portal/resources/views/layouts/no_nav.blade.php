@include("layouts.partials.head")
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
@yield('styles')
<body class="outer-body">
    @include('layouts.partials.errors')
    @include('layouts.partials.success')
    
    @yield('content')
    @include('layouts.partials.js')
</body>
</html>