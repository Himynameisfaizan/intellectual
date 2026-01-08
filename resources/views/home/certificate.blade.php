<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Certificate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('include.header')

    <div class="w-full min-h-screen bg-[#f6f8fa] py-30 px-4">

        <div class="max-w-7xl mx-auto relative mb-12">
            <div class="text-center mb-8">
                <h3 class="text-2xl md:text-3xl font-bold text-[#003366]">Download Your Certificate</h3>
                <div class="h-1 w-24 bg-[#003366] mx-auto mt-2 rounded"></div>
            </div>

            <div class="w-full max-w-sm mx-auto md:absolute md:top-0 md:left-0 flex items-center border border-gray-400 rounded-lg px-3 py-2 mt-10 bg-white shadow-sm">
                <input id="searchInput" type="text" placeholder="Search pdf name..." class="grow outline-none bg-transparent text-sm text-gray-700 placeholder-gray-500">
                <i class="ri-search-line text-gray-500 cursor-pointer"></i>
            </div>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-8 justify-center items-start">

            <div class="w-full md:w-1/2 overflow-x-auto bg-white shadow-sm border border-gray-200 rounded-md">
                <table class="w-full border-collapse min-w-75">
                    <thead>
                        <tr class="bg-gray-100 text-[#003366]">
                            <th class="p-3 border border-gray-300 font-semibold w-16">S.No.</th>
                            <th class="p-3 border border-gray-300 font-semibold text-left">File Name</th>
                            <th class="p-3 border border-gray-300 font-semibold w-20">Download</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyOdd">
                        @foreach ($oddName as $item)
                        <tr class="hover:bg-blue-50 transition searchable-row">
                            <td class="p-3 border border-gray-300 text-center">{{ $item['sno'] }}</td>
                            <td class="p-3 border border-gray-300 text-sm font-medium text-gray-700 file-name">{{ $item['approved_projects'] }}</td>
                            <td class="p-3 border border-gray-300 text-center">
                                <button onclick="openModal()" class="text-red-600 hover:scale-110 transition transform">
                                    <i class="ri-file-pdf-2-fill text-3xl"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full md:w-1/2 overflow-x-auto bg-white shadow-sm border border-gray-200 rounded-md">
                <table class="w-full border-collapse min-w-75">
                    <thead>
                        <tr class="bg-gray-100 text-[#003366]">
                            <th class="p-3 border border-gray-300 font-semibold w-16">S.No.</th>
                            <th class="p-3 border border-gray-300 font-semibold text-left">File Name</th>
                            <th class="p-3 border border-gray-300 font-semibold w-20">Download</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyEven">
                        @foreach ($evenName as $item)
                        <tr class="hover:bg-blue-50 transition searchable-row">
                            <td class="p-3 border border-gray-300 text-center">{{ $item['sno'] }}</td>
                            <td class="p-3 border border-gray-300 text-sm font-medium text-gray-700 file-name">{{ $item['approved_projects'] }}</td>
                            <td class="p-3 border border-gray-300 text-center">
                                <button onclick="openModal()" class="text-red-600 hover:scale-110 transition transform">
                                    <i class="ri-file-pdf-2-fill text-3xl"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="downloadModal" class="fixed inset-0 z-100 hidden">

        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white w-[90%] max-w-md p-6 rounded-lg shadow-2xl border border-gray-200">

            <div class="flex flex-col items-center mb-6 relative">
                <img src="{{ asset('storage/images/IP-Logo-fnl.png') }}" alt="Logo" class="w-12 h-12 object-contain mb-2">
                <h2 class="text-2xl font-bold text-[#003366]">Download PDF</h2>
                <p class="text-sm text-gray-500">Simply fill out this form</p>

                <button onclick="closeModal()" class="absolute top-0 right-0 text-gray-400 hover:text-red-500 transition">
                    <i class="ri-close-circle-line text-3xl"></i>
                </button>
            </div>

            <form id="checkForm" class="space-y-4">
                @csrf

                <div class="group">
                    <input type="text" id="name" name="name" placeholder="Enter Your Name"
                        class="w-full border-b border-gray-300 p-2 outline-none focus:border-blue-600 bg-transparent transition" required>
                    <small class="text-red-500 text-xs hidden" id="nameError">This field is required*</small>
                </div>

                <div class="group">
                    <input type="number" id="phone" name="phone" placeholder="Enter Phone Number"
                        class="w-full border-b border-gray-300 p-2 outline-none focus:border-blue-600 bg-transparent transition" required>
                    <small class="text-red-500 text-xs hidden" id="phoneError">This field is required*</small>
                </div>

                <div class="group">
                    <input type="text" id="user_id" name="user_id" placeholder="Enter Your User ID"
                        class="w-full border-b border-gray-300 p-2 outline-none focus:border-blue-600 bg-transparent transition" required>
                    <small class="text-red-500 text-xs hidden" id="idError">This field is required*</small>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-[#004a94] hover:bg-[#003366] text-white font-medium py-3 rounded-full transition duration-300 mt-4 shadow-md">
                    Submit & Download
                </button>

                <p id="formMessage" class="text-center text-sm mt-2 font-semibold"></p>
            </form>
        </div>
    </div>

    <script>
        // --- 1. Modal Logic ---
        const modal = document.getElementById('downloadModal');

        function openModal() {
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.getElementById('checkForm').reset();
            document.getElementById('formMessage').textContent = '';
        }

        // --- 2. Search Logic ---
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('.searchable-row');

        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();

            rows.forEach(row => {
                const fileName = row.querySelector('.file-name').textContent.toLowerCase();
                if (fileName.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // --- 3. Form Submission (AJAX) ---
        const form = document.getElementById('checkForm');
        const msgBox = document.getElementById('formMessage');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Reset Styles
            msgBox.textContent = "Checking...";
            msgBox.className = "text-center text-sm mt-2 text-blue-600";
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50');

            const formData = new FormData(form);

            try {
                const response = await fetch("{{ route('check_userId') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF Protection
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.status === 'success') {
                    msgBox.textContent = "Success! Downloading...";
                    msgBox.className = "text-center text-sm mt-2 text-green-600";

                    // Trigger Download
                    window.location.href = data.download_url;

                    // Optional: Close modal after delay
                    setTimeout(closeModal, 2000);
                } else {
                    msgBox.textContent = data.message;
                    msgBox.className = "text-center text-sm mt-2 text-red-600";
                }

            } catch (error) {
                console.error('Error:', error);
                msgBox.textContent = "Something went wrong. Try again.";
                msgBox.className = "text-center text-sm mt-2 text-red-600";
            } finally {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50');
            }
        });
    </script>

    @include('include.footer')


</body>

</html>