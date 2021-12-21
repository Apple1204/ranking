<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>Judo</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link href="{{ asset('material') }}/css/materialize.css" rel="stylesheet" />
    @stack('css')
    </head>
    <body>
    @include('layouts.main.header')

    @yield('content')

    @include('layouts.main.footer')

    <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="{{ asset('material') }}/js/materialize.js"></script>
    <script src="{{ asset('material') }}/js/init.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    @stack('js')
    </body>
</html>