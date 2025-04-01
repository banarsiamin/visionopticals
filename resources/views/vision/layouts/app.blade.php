<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision Opticals - @yield('title', 'Prescription')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    
    <!-- Mobiscroll CSS -->
    <link rel="stylesheet" href="https://cdn.mobiscroll.com/4.10.9/css/mobiscroll.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/prescription.css') }}">
    
    @stack('styles')
</head>
<body>
    @yield('content')
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Mobiscroll JS -->
    <script src="https://cdn.mobiscroll.com/4.10.9/js/mobiscroll.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/prescription.js') }}"></script>
    
    @stack('scripts')
</body>
</html>