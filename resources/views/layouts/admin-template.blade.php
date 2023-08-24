<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <!-- CSRF Token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>



        <!-- Fonts -->

        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,900" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

        @yield('style')

        <!-- Styles -->

        <link href="{{ asset('css/jquery.scrollbar.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @mobile
            <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">
        @endmobile

    </head>

    <body>

        @include('layouts.header')


        @include('layouts.aside')

        <main role="main" class="py-5">

            <div class="container-fluid">

                @yield('content')

            </div>

        </main>



        @include('layouts.footer')



        <!-- Scripts -->

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <script src="{{ asset('js/jquery.scrollbar.min.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

        <script src="{{ asset('js/main.js') }}"></script>

        @yield('script')

    </body>

</html>

