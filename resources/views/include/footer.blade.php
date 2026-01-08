<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <footer class="w-full mt-auto bg-[#003366] text-white">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col-reverse md:flex-row justify-between items-center gap-6 md:gap-0">

            <div class="flex flex-col gap-3 text-center md:text-left w-full md:w-auto">
                <div class="space-x-2 text-sm font-semibold tracking-wide">
                    <a href="{{ route('index') }}" class="hover:text-yellow-400 transition">Home |</a>
                    <a href="{{ route('about-us') }}" class="hover:text-yellow-400 transition">About us |</a>
                    <a href="{{ route('certificate') }}" class="hover:text-yellow-400 transition">Certificate</a>
                </div>

                <div class="text-xs text-gray-300 space-y-1">
                    <p>Content Owned, updated and maintained by Intellectual Property India, All Rights Reserved.</p>
                    <p>Web Information manager</p>
                </div>
            </div>

            <div class="flex items-center justify-center w-full md:w-auto mb-4 md:mb-0">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Footer Logo" class="h-1 md:h-20 w-auto object-contain p-2 rounded shadow-sm">
                </a>
            </div>

        </div>
    </footer>
</body>

</html>