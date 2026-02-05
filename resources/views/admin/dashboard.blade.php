<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    @include('include.admin_header')
    <div class="absolute top-25 left-70 z-10 w-[75%]">
        <h1>hello this is dashboard</h1>
    </div>
</body>

</html>