<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('Layout_service.head')
</head>
<body>
    <div class="main-content">
        @include('Layout_service.header')
        @include('Layout_service.Hero_Section')
           
    </div>

    <div class="">
        @include('Layout_service.filter') 
    </div><br>


    @include('Layout_service.footer')
    @include('Layout_service.script')
</body>
</html>