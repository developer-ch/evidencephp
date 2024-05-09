<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            scrollbar-width: 10px;
            scrollbar-color: blue orange;
            margin: 0;
            padding: 0;
        }

        /* Works on Chrome, Edge, and Safari*/
        *::-webkit-scrollbar {
            width: 12px;
        }

        *::-webkit-scrollbar-track {
            background: orange;
        }

        *::-webkit-scrollbar-thumb {
            background-color: blue;
            border-radius: 20px;
            border: 3px solid orange;
        }

        .row{
            margin: 0;
        }
        
        .carousel{
            position: absolute;
            height: 92.5%;
            width: 100%;
            margin-top: 40px;
        }
    </style>
</head>

<body oncontextmenu="return false;">
    @include('templates.includes.message')
    @yield('page')
    @yield('actions')
    @include('evidence.modals.info')
    @yield('listing')
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit()
        $('#btn-update-page').on("click", () => window.location.reload(true))
    </script>
    @stack('scripts')
</body>

</html>
