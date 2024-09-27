<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/materialize/materialize.min.css') }}">
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

        .row {
            margin: 0;
        }

        .carousel {
            position: absolute;
            height: 92.5%;
            width: 100%;
            margin-top: 40px;
        }

        table {
            position: relative;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        table tr>td {
            max-width: 30.5rem;
            padding: 0.3rem 0.6rem;
            border-bottom: 1px solid #ccc;
            overflow: auto;
            /*white-space: nowrap;
            text-overflow: clip;*/
        }

        table>thead>tr>th {
            background: darkblue;
            position: sticky;
            border-left: #ffffff 1px solid;
            top: 0;
            /* Don't forget this, required for the stickiness */
            color: #ffffff;
            padding: 0.3rem 0.6rem;
            min-width: 6rem;
        }

        .title_box {
            border-top: black 2px solid;
        }

        .title_box #title {
            position: relative;
            top: -0.5em;
            margin-left: 1em;
            display: inline;
            background-color: white;
        }
    </style>
</head>

<body>
    @include('includes.message')
    @yield('page')
    @yield('actions')
    @include('evidence.modals.info')
    @yield('listing')
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/materialize/materialize.min.js') }}"></script>
    <script>
        M.AutoInit()
        $('#btn-update-page').on("click", () => window.location.reload(true))
    </script>
    @stack('scripts')
</body>

</html>