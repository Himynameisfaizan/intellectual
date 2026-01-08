<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body">
    @include('include.admin_header')

    <div class="absolute top-25 left-70 z-10 w-[75%]">
        <form class="flex flex-col gap-5" action="admin" method="post" enctype="multipart/form-data">
            @csrf
            <input required class="border border-[#00000050] p-2 rounded-lg outline-[#00000050] cursor-pointer" type="text" placeholder="Enter approved project" name="approved_project">
            <input required class="border border-[#00000050] p-2 rounded-lg outline-[#00000050] cursor-pointer" type="text" placeholder="Enter pdf" name="pdf">
            <input required class="border border-[#00000050] p-2 rounded-lg outline-[#00000050] cursor-pointer" type="text" placeholder="Enter password" name="password">
            <input required class="border border-[#00000050] p-2 rounded-lg outline-[#00000050] cursor-pointer" type="text" placeholder="Enter user id" name="user_id">
            <input required class="border border-[#00000050] p-2 rounded-lg outline-[#00000050] cursor-pointer" type="file" name="imageUpload">
            <input class="border border-[#00000050] w-[20%] active:scale-95 bg-[#003366] text-white p-2 rounded-lg outline-[#00000050] cursor-pointer" type="submit" value="Insert image">
        </form>
    </div>
    </body>

</html>