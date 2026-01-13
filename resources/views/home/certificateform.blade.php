<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <main class=" w-[100wh] h-[100vh]">
       <section class="w-full h-full" style="
        background-image: url('{{ asset('storage/images/certificate.jpg') }}'); 
        background-repeat: no-repeat;
        background-size: contain;
        background-position:center;
        "
        ></section> 
    </main>
</body>
</html>
