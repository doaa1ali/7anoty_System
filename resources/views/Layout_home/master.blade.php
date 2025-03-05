<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('Layout_home.head')
</head>
<body>
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="main-content">
        @include('Layout_home.header')
        @include('Layout_home.Hero_Section')
        @include('Layout_home.services')
        @include('Layout_home.prayers')     
    </div>
    @include('Layout_home.footer')
    @include('Layout_home.script')
</body>
</html>