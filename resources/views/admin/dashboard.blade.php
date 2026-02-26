@include('include.admin_header')

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">Manage your projects and certificates efficiently.</p>
        </div>
        <div class="flex items-center">
            <span class="bg-blue-50 text-[#003366] px-4 py-2 rounded-xl font-bold border border-blue-100 flex items-center gap-2 shadow-sm">
                <i class="ri-calendar-check-line"></i>
                {{ date('d M, Y') }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-blue-200 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Active Projects</p>
                    <h3 class="text-4xl font-black text-gray-800 mt-2">{{ $totalProjects }}</h3>
                </div>
                <div class="w-16 h-16 bg-blue-50 text-[#003366] rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform shadow-inner">
                    <i class="ri-folder-open-fill"></i>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('new_project_details') }}" class="inline-flex items-center text-sm text-blue-600 font-bold hover:gap-2 transition-all">
                    View all projects <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
        </div>

        <div class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-green-200 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Live Certificates</p>
                    <h3 class="text-4xl font-black text-gray-800 mt-2">{{ $totalCertificates }}</h3>
                </div>
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform shadow-inner">
                    <i class="ri-file-pdf-2-fill"></i>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ url('/admin/pdf-generator') }}" class="inline-flex items-center text-sm text-green-600 font-bold hover:gap-2 transition-all">
                    Generate PDFs <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
        </div>

        <div class="bg-linear-to-br from-[#003366] to-[#002855] p-8 rounded-3xl shadow-lg shadow-blue-900/20 text-white flex flex-col justify-between">
            <div>
                <h4 class="text-xl font-bold">New Project</h4>
                <p class="text-blue-200 text-sm mt-1">Ready to start something new?</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('home_details') }}" class="bg-white text-[#003366] px-5 py-2.5 rounded-xl font-bold text-sm inline-flex items-center gap-2 hover:bg-blue-50 transition-colors">
                    <i class="ri-add-line"></i> Add Now
                </a>
            </div>
        </div>
    </div>

    <div class="mt-12 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="ri-pulse-line text-blue-500"></i> System Overview
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <p class="text-xs font-bold text-gray-400 uppercase">Latest Update</p>
                <p class="text-sm text-gray-700 mt-1 font-medium">Django to Laravel migration complete.</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <p class="text-xs font-bold text-gray-400 uppercase">Server Status</p>
                <p class="text-sm text-green-600 mt-1 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Online
                </p>
            </div>
        </div>
    </div>
</div>

</main>
</div>
</div>
</body>

</html>