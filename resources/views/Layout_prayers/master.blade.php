<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('Layout_prayers.head')
</head>
<body>
    <div class="main-content">
        @include('Layout_prayers.header')
        @include('Layout_prayers.Hero_Section')   
    </div>

    <div class="">
        @include('Layout_prayers.filter') 
    </div><br>


    @include('Layout_prayers.footer')
    @include('Layout_prayers.script')
</body>
</html>