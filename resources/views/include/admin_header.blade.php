<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

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
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-[#003366] lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex items-center justify-center h-16 bg-[#002855] border-b border-[#ffffff20]">
                <div class="text-white text-2xl font-bold flex items-center gap-2">
                    <i class="ri-dashboard-3-line"></i> AdminPanel
                </div>
            </div>

            <nav class="mt-5 px-4 space-y-2">

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase">Main</p>

                <a href="#" class="flex items-center px-4 py-2 text-white bg-[#ffffff20] rounded-md group">
                    <i class="ri-home-4-line mr-3 text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-user-line mr-3 text-lg"></i>
                    <span class="font-medium">Users</span>
                </a>

                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-article-line mr-3 text-lg"></i>
                    <span class="font-medium">Posts</span>
                </a>

                <p class="px-2 mt-5 text-xs font-semibold text-gray-400 uppercase">Settings</p>

                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-settings-3-line mr-3 text-lg"></i>
                    <span class="font-medium">Settings</span>
                </a>

                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-[#ffffff10] hover:text-white rounded-md transition duration-200 group">
                    <i class="ri-logout-box-line mr-3 text-lg"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </nav>
        </aside>
        <div class="flex flex-col flex-1 overflow-hidden">

            <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm h-16">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="ri-menu-2-line text-2xl"></i>
                    </button>

                    <div class="relative mx-4 lg:mx-0 hidden md:block">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="ri-search-line text-gray-500"></i>
                        </span>
                        <input class="w-full pl-10 pr-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003366] focus:bg-white" type="text" placeholder="Search...">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative text-gray-500 hover:text-[#003366]">
                        <i class="ri-notification-3-line text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <div class="flex items-center gap-2 cursor-pointer">
                        <img class="w-8 h-8 rounded-full object-cover border border-gray-300" src="https://ui-avatars.com/api/?name=Admin+User&background=003366&color=fff" alt="User avatar">
                        <span class="hidden md:block text-sm font-medium text-gray-700">Admin User</span>
                    </div>
                </div>
            </header>
            <!-- <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <h3 class="text-gray-700 text-3xl font-medium">Dashboard Overview</h3>

                <div class="mt-4">
                    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
                        <div class="w-full px-4 py-5 bg-white rounded-lg shadow-sm border-l-4 border-[#003366]">
                            <div class="text-sm font-medium text-gray-500 truncate">
                                Total Users
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-gray-900">
                                12,000
                            </div>
                        </div>
                        <div class="w-full px-4 py-5 bg-white rounded-lg shadow-sm border-l-4 border-orange-500">
                            <div class="text-sm font-medium text-gray-500 truncate">
                                Total Orders
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-gray-900">
                                450
                            </div>
                        </div>
                        <div class="w-full px-4 py-5 bg-white rounded-lg shadow-sm border-l-4 border-green-500">
                            <div class="text-sm font-medium text-gray-500 truncate">
                                Total Profit
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-gray-900">
                                $45,000
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold mb-4 text-[#003366]">Recent Activities</h2>
                        <p class="text-gray-600">Yaha par table ya baaki content aayega...</p>
                    </div>
                </div>
            </main> -->
        </div>
    </div>

</body>

</html>