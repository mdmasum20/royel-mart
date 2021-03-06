<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
            <!-- for header link -->
            @include('layouts.backend.partial.head')
            <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
            <!-- for css input -->
            @stack('css')
        </head>
    <body>
        <div class="theme-loader">
            <div class="ball-scale">
                <div class='contain'>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header">
                    @include('layouts.backend.partial.header')
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            @include('layouts.backend.partial.sidebar')
                        </nav>
                        <div class="pcoded-content">
                            @yield('content')
                        </div>
                        @include('layouts.backend.partial.footer')
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.backend.partial.foot')
        <script src="{{asset('massage/toastr/toastr.js')}}"></script>
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    toastr.error('{{ $error }}','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                @endforeach
            @endif
        </script>
        @stack('js')
    </body>
</html>