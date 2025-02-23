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
</body>
</html>
