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
    <main class="absolute top-20 left-70 z-10 w-[75%]">
        <h1 class="text-3xl font-bold m-6 p-1">hello</h1>
    </main>
</body>

</html>