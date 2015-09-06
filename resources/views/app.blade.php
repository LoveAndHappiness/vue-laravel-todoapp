<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="token" value="{{ csrf_token() }}">
    <title>Vue Todo App</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>



    <script src="js/app.js"></script>
</body>
</html>