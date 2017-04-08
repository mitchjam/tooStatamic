<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Statamic Converter</title>

        <meta name="description" content="This is an implementation of Jack Mcdades statamic importer.">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    </head>
    <body>

        @if($errors->any())
            <div class="notification is-danger has-text-centered">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <div class="section">
            <div class="container">
                <div class="columns">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>