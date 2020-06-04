<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @yield('styles')
</head>
<body>
    <div class="mainbody background">
        @yield('content')
    </div>
    
    @yield('scripts')
</body>
</html>