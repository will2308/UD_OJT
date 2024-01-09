<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ url('assets/image/logo.png') }}" rel="icon">

        <title>UD Punama Jaya</title>

        <link href="https://bootswatch.com/5/sketchy/bootstrap.css" rel="stylesheet">
        <link href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        
    </head>
    <body>

        <div id="page-content-wrapper" class="container">
            {{-- header --}}
            @include('layout.header')

            <!-- Page content-->
            <div id="content">
                 @yield('content')
            </div>
                
        </div>
        <br>

        {{-- <script src="{{ url('assets/js/ajax-jquery.js') }}"></script> --}}
        {{-- <script src="{{ url('assets/js/jquery.min.js') }}"></script> --}}
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="{{ url('assets/js/bootstrap.min.js') }}"></script> --}}
        <script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>
    </body>
</html>