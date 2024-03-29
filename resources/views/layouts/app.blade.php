<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('/css/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a href="{{ ('/tasks') }}" class="navbar-brand">Tasks</a>
        @if(Auth::user())
        <a class="nav-link navbar-nav ml-auto">{{ Auth::user()->username }}</a>
        <form action="{{ url('logout')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <input class="btn btn-outline my-2 my-sm-0" type="submit" type="submit" value="Logout"/>
        </form>
        @endif
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        @yield('footer')
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>