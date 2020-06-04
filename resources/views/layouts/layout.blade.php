<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{Route('index')}}">Home</a>
            </li>
        </ul>

    </nav>
    <div class="container">
        @yield('content')
    </div>
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>   
        @endif
    
    @yield('scripts')
</body>
</html>