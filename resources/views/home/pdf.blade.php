<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intellectual</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('include.header')

    <main class="relative w-full max-w-6xl mx-auto px-6 py-12 md:py-16 flex flex-col items-center justify-center min-h-[100vh] lg-[60vh]
    mt-10">
        <section id="projectDetail" class="bg-[#fefefe] max-w-2xl mx-auto w-full border border-neutral-300 rounded-lg shadow-lg ">
            <form class="flex flex-col gap-7 px-8 pb-10 pt-5" onsubmit="projectDetailForm()">
                <h3 class="text-center font-medium text-2xl mb-5">Approved project detail</h3>
                <div class="flex flex-col gap-1">
                    <label for="projectName" class="font-medium text-sm">Pdf name<span class="text-rose-500 font-medium">*</span></label>
                    <input type="text" id="projectName" name="projectName" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200" required>
                </div>
                <div class="flex gap-1">
                    <div class="basis-1/2 flex flex-col gap-1">
                        <label for="clientName" class="font-medium text-sm">Client name<span class="text-rose-500 font-medium">*</span></label>
                        <input type="text" id="clientName" name="clientName" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                        transition-all duration-200" required>
                    </div>
                    <div class="basis-1/2 flex flex-col gap-1">
                        <label for="date" class="font-medium text-sm">Date<span class="text-rose-500 font-medium">*</span></label>
                        <input type="date" id="date" name="date" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                        transition-all duration-200" required>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="gst" class="font-medium text-sm">Logo name with GST<span class="text-rose-500 font-medium">*</span></label>
                    <input type="text" id="gst" name="gst" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200" required>
                </div>
                <div class="flex  gap-1 justify-between items-center">
                    <div class="w-[50%] flex flex-col">
                        <label for="pdf" class="font-medium text-sm">Pdf<span class="text-rose-500 font-medium">*</span></label>
                        <input type="file" id="pdf" name="pdf" accept="application/pdf" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                        transition-all duration-200" required>
                    </div>
                    <div class="w-[50%] flex flex-col">
                        <label for="logo" class="font-medium text-sm">Logo<span class="text-rose-500 font-medium">*</span></label>
                        <input type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                        transition-all duration-200" required>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="address" class="font-medium text-sm">Address<span class="text-rose-500 font-medium">*</span></label>
                    <textarea name="address" id="address" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200"></textarea>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="userId" class="font-medium text-sm">User-id<span class="text-rose-500 font-medium">*</span></label>
                    <input type="text" id="userId" name="userId" class="border border-neutral-400 rounded py-0.5 pl-2 focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                    transition-all duration-200" required>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="userPassword" class="font-medium text-sm">Password<span class="text-rose-500 font-medium">*</span></label>
                    <div class="flex justify-between gap-1">
                        <input type="text" id="userPassword" name="userPassword" value="" class="border border-neutral-400 rounded py-0.5 pl-2 
                        focus:border-blue-400 focus:ring-2 ring-blue-300 outline-none
                        transition-all duration-200 flex-1" required>
                        <i class="ri-user-settings-line bg-blue-400 px-2 py-1 border-neutral-400 border rounded bg-neutral-100 
                        cursor-pointer" title="password Generate" onclick="generateRandomString(10)"></i>
                    </div>
                </div>
                <button class="bg-[#003366] py-1 text-white rounded-2xl cursor-pointer hover:bg-[#0c3863] transition-all duration-100">Submit</button>
            </form>
        </section>

        <section id="adminView" class="absolute bg-[#fefefe] max-w-[400px] mx-auto w-full border border-neutral-300 rounded-lg shadow-lg top-[50%] left-[50%]
        -translate-y-[50%] -translate-x-[50%] transition-all duration-400 hidden">
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
                <input value="Submit" type="submit" class="bg-[#003366] py-1 text-white rounded-2xl cursor-pointer hover:bg-[#0c3863] transition-all duration-100">

            </form>
        </section>

    </main>

    @include('include.footer')
    <script>
        let adminView = document.getElementById("adminView");
        let projectDetail = document.getElementById("projectDetail");
        let userPassword = document.getElementById("userPassword");

        function showPopup() {
            event.preventDefault();
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

        function projectDetailForm() {
            event.preventDefault();

        }

        function generateRandomString(length = 10) {
            const chars =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"

            const randomValues = new Uint8Array(length)
            window.crypto.getRandomValues(randomValues)

            let result = "it_"
            for (let i = 0; i < length; i++) {
                result += chars[randomValues[i] % chars.length]
            }

            userPassword.value = result;
        }
    </script>
</body>

</html>