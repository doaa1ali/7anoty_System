<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('Layout_home.head')
</head>
<body>
    <div class="main-content">
        @include('Layout_home.header')
        @include('Layout_service.Hero_Section')
           
    </div>

    <div class="">
        @include('Layout_hall.halls') 
    </div><br>


    @include('Layout_home.footer')
    @include('Layout_home.script')
</body>
</html>