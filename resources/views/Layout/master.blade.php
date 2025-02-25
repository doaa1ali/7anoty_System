<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('Layout.head')
</head>
<body>
    @include('Layout.Sidebar')
    <div class="main-content">
        @include('Layout.header')
        @yield('Show-Books')
    </div>

    @include('Layout.script')

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu4T0sSqqn87uvqXHcUbbWpxt4NVyBW6w                                                                                                                                                                                                                                                                                                                                                                                                &loading=async&libraries=places,drawing&callback=myMap&language=ar&region=EG">
    </script>
</body>
</html>
