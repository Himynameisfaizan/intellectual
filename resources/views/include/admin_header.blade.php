<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Custom Font agar chahiye to */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed h-screen inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-[#003366] lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex items-center justify-center h-16 bg-[#002855] border-b border-[#ffffff20]">
                <div class="text-white text-2xl font-bold flex items-center justify-center">
                    <a class="flex items-center gap-2" href="{{ url('/admin') }}">
                        <img class="w-8 h-8 object-contain" src="/storage/images/it.png" alt="">
                        AdminPanel
                    </a>
                </div>
            </div>

            <nav class="mt-5 px-4 space-y-2">

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase">Dashboard</p>

                <a href="{{ url('/admin') }}" class="flex items-center px-4 py-2 text-white bg-[#ffffff20] rounded-md group">
                    <i class="ri-home-4-line mr-3 text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <p class="px-2 mt-5 text-xs font-semibold text-gray-400 uppercase">Insert Data</p>

                <a href="{{ url('/admin/pdf-generator') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-user-line mr-3 text-lg"></i>
                    <span class="font-medium">Generate PDF</span>
                </a>

                <a href="{{ url('/admin/home-details') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-article-line mr-3 text-lg"></i>
                    <span class="font-medium">Home & Pdf</span>
                </a>

                <a href="{{ url('/admin/new-project-details') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-add-box-line mr-3 text-lg"></i>
                    <span class="font-medium">New projects</span>
                </a>
            </nav>
        </aside>
        <div class="flex flex-col flex-1 overflow-hidden">

            <header class="flex items-center justify-end px-6 py-4 bg-white shadow-sm h-16">

                {{-- Sirf login user ko dikhega --}}
                @auth
                <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-md">
                    <i class="ri-user-follow-line text-[#003366]"></i>
                    <span class="font-medium text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                </div>

                <div class="px-4 py-2">
                    <button onclick="confirmLogout()"
                        class="flex items-center gap-3 w-full px-4 py-1.5 text-red-600 cursor-pointer bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200 font-medium">
                        <i class="ri-logout-box-r-line text-xl"></i>
                        <span>Logout</span>
                    </button>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                @endauth

            </header>

        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you really want to logout?")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>

</body>

</html>