<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta name="user-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
    
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Al_Hanoty System</title>
    @include('Layout_home.style')
</head>
