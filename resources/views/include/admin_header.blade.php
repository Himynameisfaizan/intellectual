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
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: "Are you sure you want to exit?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#003366',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Yes, Logout!',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3',
                    cancelButton: 'rounded-xl px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <div x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden">
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-[#003366] lg:translate-x-0 lg:static lg:inset-0 shrink-0">

            <div class="flex items-center justify-between h-16 bg-[#002855] border-b border-[#ffffff20] px-6">
                <div class="text-white text-xl font-bold flex items-center gap-2">
                    <img class="w-8 h-8 object-contain" src="/storage/images/it.png" alt="Logo">
                    <span>AdminPanel</span>
                </div>
                <button @click="sidebarOpen = false" class="text-white lg:hidden">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <nav class="mt-5 px-4 space-y-2">
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Dashboard</p>
                <a href="{{ url('/admin/dashboard') }}"
                    class="flex items-center px-4 py-2.5 rounded-md transition duration-200 group {{ request()->is('admin/dashboard') ? 'bg-white text-[#003366] font-bold shadow-lg' : 'text-gray-300 hover:bg-[#ffffff10] hover:text-white' }}">
                    <i class="ri-home-4-line mr-3 text-lg"></i>
                    <span>Dashboard</span>
                </a>

                <p class="px-2 mt-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>
                <a href="{{ url('/admin/pdf-generator') }}"
                    class="flex items-center px-4 py-2.5 rounded-md transition duration-200 group {{ request()->is('admin/pdf-generator') ? 'bg-white text-[#003366] font-bold shadow-lg' : 'text-gray-300 hover:bg-[#ffffff10] hover:text-white' }}">
                    <i class="ri-file-pdf-2-line mr-3 text-lg"></i>
                    <span>Generate PDF</span>
                </a>

                <a href="{{ url('/admin/home-details') }}"
                    class="flex items-center px-4 py-2.5 rounded-md transition duration-200 group {{ request()->is('admin/home-details') ? 'bg-white text-[#003366] font-bold shadow-lg' : 'text-gray-300 hover:bg-[#ffffff10] hover:text-white' }}">
                    <i class="ri-article-line mr-3 text-lg"></i>
                    <span>Projects & Pdf</span>
                </a>

                <a href="{{ url('/admin/new-project-details') }}"
                    class="flex items-center px-4 py-2.5 rounded-md transition duration-200 group {{ request()->is('admin/new-project-details') ? 'bg-white text-[#003366] font-bold shadow-lg' : 'text-gray-300 hover:bg-[#ffffff10] hover:text-white' }}">
                    <i class="ri-add-box-line mr-3 text-lg"></i>
                    <span>New Projects</span>
                </a>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <header class="flex items-center justify-between lg:justify-end px-6 py-4 bg-white shadow-sm h-16 shrink-0">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="ri-menu-2-fill text-2xl"></i>
                </button>

                @auth
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-full border border-gray-200">
                        <i class="ri-user-star-line text-[#003366]"></i>
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                    </div>
                    <button onclick="confirmLogout()" class="flex items-center gap-2 px-4 py-1.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-full transition-all duration-200 font-bold text-sm cursor-pointer">
                        <i class="ri-logout-box-r-line"></i>
                        <span class="xs:block">Logout</span>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
                @endauth
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">