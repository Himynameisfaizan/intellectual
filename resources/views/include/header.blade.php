<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="fixed top-0 left-0 w-full h-[10vh] bg-[#003366] text-white shadow-lg z-50 font-sans">
    <div class="flex justify-between items-center h-full px-6 md:px-12 w-full">
        
        <div class="shrink-0 h-full py-2 flex items-center">
            <a href="{{ route('index') }}" class="h-full block">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-[60%] md:h-[80%] w-auto object-contain mt-2 md:mt-1">
            </a>
        </div>

        <div class="hidden md:flex items-center gap-8">
            <nav class="flex gap-6">
                <a href="{{ route('index') }}" class="text-white hover:text-yellow-400 text-[15px] font-medium transition duration-300">Home</a>
                <a href="{{ route('about-us') }}" class="text-white hover:text-yellow-400 text-[15px] font-medium transition duration-300">About-us</a>
                <a href="{{ route('certificate') }}" class="text-white hover:text-yellow-400 text-[15px] font-medium transition duration-300">Certificate</a>
            </nav>
            
            <div class="hidden lg:block text-sm opacity-90 border-l border-white pl-6">
                <p>info@gmail.com</p>
            </div>
        </div>

        <div class="md:hidden flex items-center">
            <button id="mobile-menu-btn" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden absolute top-[10vh] left-0 w-full bg-[#004080] text-white shadow-xl md:hidden transition-all duration-300 ease-in-out">
        <ul class="flex flex-col items-center py-4 space-y-4 border-t border-[#0055aa]">
            <li class="w-full text-center hover:bg-[#003366] py-2">
                <a href="{{ route('index') }}" class="block w-full text-lg">Home</a>
            </li>
            <li class="w-full text-center hover:bg-[#003366] py-2">
                <a href="{{ route('about-us') }}" class="block w-full text-lg">About</a>
            </li>
            <li class="w-full text-center hover:bg-[#003366] py-2">
                <a href="{{ route('certificate') }}" class="block w-full text-lg">Certificates</a>
            </li>
        </ul>
    </div>
</header>

<script>
    // Logic to toggle mobile menu
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
</body>

</html>