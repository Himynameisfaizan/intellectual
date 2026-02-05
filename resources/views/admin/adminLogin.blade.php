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

    <main class="absolute top-25 left-70 z-10 w-[75%]">
        <section class="flex justify-center bg-gray-100 px-4">
            <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
                <div class="bg-[#003366] p-6 text-center">
                    <h3 class="text-white font-bold text-2xl uppercase tracking-wider">Admin Portal</h3>
                    <p class="text-blue-100 text-sm mt-1">Please verify your credentials</p>
                </div>

                <form action="{{ route('admin.login.submit') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-3 mb-4">
                        <p class="text-red-700 text-sm">{{ $errors->first() }}</p>
                    </div>
                    @endif

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-600 flex items-center gap-2">
                            <i class="ri-mail-line text-[#003366]"></i> Email Address
                        </label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="admin@example.com">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-600 flex items-center gap-2">
                            <i class="ri-lock-line text-[#003366]"></i> Password
                        </label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#003366] hover:bg-[#0c3863] text-white font-bold py-3 cursor-pointer rounded-lg shadow-lg transform active:scale-95 transition-all duration-200 flex items-center justify-center gap-2">
                        Login to Dashboard <i class="ri-arrow-right-line"></i>
                    </button>
                </form>
            </div>
        </section>
    </main>

    </body>

</html>