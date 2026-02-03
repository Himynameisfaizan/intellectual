<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body">
    @include('include.admin_header')

    <main class="absolute top-75 left-70 z-10 w-[75%]">
        <section id="adminView" class="absolute bg-[#fefefe] max-w-100 mx-auto w-full border border-neutral-300 rounded-lg shadow-lg top-[50%] left-[50%]
        -translate-y-[50%] -translate-x-[50%] transition-all duration-400">
            <form class="flex flex-col gap-7 px-8 pb-10 pt-5" onsubmit="showPopup();">
                <h3 class="text-center font-medium text-2xl mb-5">Admin Verify</h3>
                <div class="flex flex-col gap-1">
                    <label for="name" class="font-medium text-sm">Name<span class="text-rose-500 font-medium">*</span></label>
                    <input type="text" id="name" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="passowrd" class="font-medium text-sm">Password<span class="text-rose-500 font-medium">*</span></label>
                    <input type="password" id="password" name="password" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200">
                </div>
                <input value="Submit" type="submit" class="bg-[#003366] py-1 text-white rounded cursor-pointer hover:bg-[#0c3863] transition-all duration-100">

            </form>
        </section>
    </main>

    <script>
        let adminView = document.getElementById("adminView");
        let projectDetail = document.getElementById("projectDetail");
        let userPassword = document.getElementById("userPassword");

        function showPopup() {
            let adminName = "Happy";
            let adminPass = "1234";
            let name = document.getElementById("name").value;
            let password = document.getElementById("password").value;

            if (name === adminName && password === adminPass) {
                alert("Correct Information");
                adminView.classList.add("hidden");
                projectDetail.classList.remove("hidden");
            } else {
                alert("Incorrect Information");
                adminView.classList.remove("hidden");
                projectDetail.classList.add("hidden");
            };
        };
    </script>
    </body>

</html>