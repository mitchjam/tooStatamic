<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Statamic Converter</title>

        <meta name="title" content="Wordpress to Statamic Converter" />
        <meta name="robots" content="index,follow" />
        <meta name="description" content="Convert your Wordpress posts to Stataimic. An implemsentation of Jack Mcdades Wordpress to Statamic importer." />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        
        @if(! App::isLocal())
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-57598949-7', 'auto');
            ga('send', 'pageview');
        </script>
        @endif

    </head>
    <body>

        @if(session('message'))
            <div class="notification is-primary has-text-centered">
                <li>{{ session('message') }}</li>
            </div>
        @endif

        @if($errors->any())
            <div class="notification is-danger has-text-centered">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <div class="container">                
            @yield('content')
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>