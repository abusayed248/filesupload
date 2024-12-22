<!doctype html>
<html lang="en">
    <head>
        <title>Easyuploads @yield('title')</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="{{ asset('files') }}/css/style.css">
    </head>
    <body>

        {{-- header section start --}}
        @include('backend.components.header')
        {{-- header section end --}}
        

        @yield('content')

        {{-- footer section start --}}
        @include('backend.components.footer')
        {{-- footer section end --}}
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>