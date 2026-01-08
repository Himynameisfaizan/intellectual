<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('include.header')


    <div class="w-full max-w-6xl mx-auto px-6 py-12 md:py-16">

        <div class="flex flex-col items-center py-10">
            <div class="text-center mb-8">
                <h3 class="text-2xl md:text-3xl font-bold text-[#003366] leading-tight">
                    Controller General of Patents, Designs, and Trade Marks
                </h3>
                <div class="h-1 w-40 bg-[#003366] mx-auto mt-2 rounded"></div>
            </div>

            <div class="w-full md:w-4/5 text-justify text-gray-700 leading-7 tracking-wide space-y-4 font-sans text-sm md:text-base">
                <p>
                    The Office of the Controller General of Patents, Designs & Trade Marks (CGPDTM) is located at Mumbai.
                    The Head Office of the Patent office is at Kolkata and its Branch offices are located at Chennai, New
                    Delhi and Mumbai. The Trade Marks registry is at Mumbai and its Branches are located in Kolkata,
                    Chennai, Ahmedabad and New Delhi. The Design Office is located at Kolkata in the Patent Office.
                </p>
                <p>
                    The Offices of The Patent Information System (PIS) and National Institute of Intellectual Property
                    Management (NIIPM) are at Nagpur. The Controller General supervises the working of the Patents Act,
                    1970, as amended, the Designs Act, 2000 and the Trade Marks Act, 1999 and also renders advice to the
                    Government on matters relating to these subjects.
                </p>
                <p>
                    In order to protect the Geographical Indications of goods a Geographical Indications Registry has been
                    established in Chennai to administer the Geographical Indications of Goods (Registration and
                    Protection) Act, 1999 under the CGPDTM.
                </p>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-8 mt-16 max-w-5xl mx-auto">

            <div class="w-40 h-40 bg-white border border-gray-300 rounded-lg shadow-md flex flex-col justify-center items-center gap-4 transition-all duration-300 group hover:bg-[#003366] hover:shadow-xl hover:-translate-y-1 cursor-pointer">
                <i class="ri-file-paper-2-line text-5xl text-[#003366] transition-colors duration-300 group-hover:text-white"></i>
                <h4 class="text-sm font-semibold text-black transition-colors duration-300 group-hover:text-white">Patent</h4>
            </div>

            <div class="w-40 h-40 bg-white border border-gray-300 rounded-lg shadow-md flex flex-col justify-center items-center gap-4 transition-all duration-300 group hover:bg-[#003366] hover:shadow-xl hover:-translate-y-1 cursor-pointer">
                <i class="ri-computer-line text-5xl text-[#003366] transition-colors duration-300 group-hover:text-white"></i>
                <h4 class="text-sm font-semibold text-black transition-colors duration-300 group-hover:text-white">Designs</h4>
            </div>

            <div class="w-40 h-40 bg-white border border-gray-300 rounded-lg shadow-md flex flex-col justify-center items-center gap-4 transition-all duration-300 group hover:bg-[#003366] hover:shadow-xl hover:-translate-y-1 cursor-pointer">
                <i class="ri-registered-line text-5xl text-[#003366] transition-colors duration-300 group-hover:text-white"></i>
                <h4 class="text-sm font-semibold text-black transition-colors duration-300 group-hover:text-white">Trade Mark</h4>
            </div>

        </div>

        <div class="mt-20">
            <div class="text-center mb-10">
                <h1 class="text-2xl md:text-3xl font-bold text-[#003366]">How To Download Your Certificate</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">

                <div class="flex items-center gap-4 p-5 cursor-pointer bg-gray-50 border border-[#003366] rounded-lg shadow-sm hover:shadow-lg transition">
                    <i class="ri-award-line text-4xl text-[#003366]"></i>
                    <p class="text-lg font-medium text-gray-800">Go to certificate menu</p>
                </div>

                <div class="flex items-center gap-4 p-5 cursor-pointer bg-gray-50 border border-[#003366] rounded-lg shadow-sm hover:shadow-lg transition">
                    <i class="ri-store-2-line text-4xl text-[#003366]"></i>
                    <p class="text-lg font-medium text-gray-800">Select Your Brand Name</p>
                </div>

                <div class="flex items-center gap-4 p-5 cursor-pointer bg-gray-50 border border-[#003366] rounded-lg shadow-sm hover:shadow-lg transition">
                    <i class="ri-lock-password-line text-4xl text-[#003366]"></i>
                    <p class="text-lg font-medium text-gray-800">Put Your Login-id & Password</p>
                </div>

                <div class="flex items-center gap-4 p-5 cursor-pointer bg-gray-50 border border-[#003366] rounded-lg shadow-sm hover:shadow-lg transition">
                    <i class="ri-download-cloud-2-line text-4xl text-[#003366]"></i>
                    <p class="text-lg font-medium text-gray-800">Download Your Certificate</p>
                </div>

            </div>
        </div>

    </div>

    @include('include.footer')

</body>

</html>