<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" oncontextmenu="return false;">
    @include('includes.message')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" style="overflow:auto;height:66vh;overflow:auto;width:100%">
        <div class="fixed-action-btn">
            <a href="{{ route('evidence.index') }}" class="btn-floating btn-large indigo darken-4 tooltipped"
                data-tooltip='Fechar' data-position="bottom" data-tooltip='Fechar Visualização' data-position="bottom">
                <i class="large material-icons">close</i>
            </a>
            <ul>
                <li><a href="{{ route('register') }}" class="btn-floating indigo darken-4 tooltipped" data-tooltip='Add Usuario' data-position="bottom"><i class="material-icons">person_add</i></a></li>
            </ul>
        </div>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit()
        $(document).ready(function() {
            $('.fixed-action-btn').floatingActionButton();
        });
    </script>
    @stack('scripts')
</body>

</html>
