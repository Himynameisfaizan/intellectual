<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        
        <div class="bg-[#003366] p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 rounded-full mb-4">
                <i class="ri-admin-line text-white text-3xl"></i>
            </div>
            <h3 class="text-white font-bold text-2xl uppercase tracking-widest">Admin Portal</h3>
            <p class="text-blue-100 text-sm mt-2 opacity-80">Please verify your credentials to continue</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" class="p-8 space-y-6">
            @csrf

            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-4 animate-pulse">
                <div class="flex items-center gap-2">
                    <i class="ri-error-warning-line text-red-500"></i>
                    <p class="text-red-700 text-xs font-bold">{{ $errors->first() }}</p>
                </div>
            </div>
            @endif

            <div class="space-y-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-mail-fill text-[#003366]"></i> Email Address
                </label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all bg-gray-50"
                    placeholder="admin@example.com">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-lock-2-fill text-[#003366]"></i> Password
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all bg-gray-50"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-[#003366] hover:bg-[#0c3863] text-white font-bold py-4 cursor-pointer rounded-xl shadow-lg shadow-blue-900/20 transform active:scale-95 transition-all duration-200 flex items-center justify-center gap-3">
                <span>Login to Dashboard</span>
                <i class="ri-arrow-right-circle-line text-xl"></i>
            </button>
            
            <div class="text-center">
                <a href="/" class="text-xs text-gray-400 hover:text-[#003366] transition-colors underline">Back to Website</a>
            </div>
        </form>
    </div>

</body>
</html>