<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://www.google.com/jsapi"></script>
    <style>
        .image {
            position:relative;
            width:100%;
            height:100%;
        }
        .image img {
            width:100%;
            vertical-align:top;
            height: 100%;
            object-fit: cover;
        }
        .image:after {
            content:'\A';
            position:absolute;
            width:100%; height:100%;
            top:0; left:0;
            background:rgba(0,0,0,0.6);
            opacity:1;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Главная</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link @if(request()->route('object') == 'vehicles') active @endif" href="/list/vehicles">Транспорты</a>
                <a class="nav-item nav-link @if(request()->route('object') == 'pedestrians') active @endif" href="/list/pedestrians">Пешеходы</a>
            </div>
        </div>
    </nav>
    @yield('content')

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
