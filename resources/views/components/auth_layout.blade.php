<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('css/layout_home/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout_creator/register.css') }}">

    <style>
        body {
            background:  url("{{ asset('uploads/ImageWebsite/28.jpg') }}");;
        }
    </style>
</head>

<body>
    <h1 >أهلا بك في صفحة {{$word}}</h1>
    <br>
   {{$slot}}


</body>
</html>
