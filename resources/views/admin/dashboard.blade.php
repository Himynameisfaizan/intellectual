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
            <i class="ri-download-cloud-2-line text-blue-500"></i> Recent Downloads
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold text-gray-400 uppercase border-b border-gray-50">
                        <th class="pb-4 px-4">User Details</th>
                        <th class="pb-4 px-4">User ID</th>
                        <th class="pb-4 px-4">Project Downloaded</th>
                        <th class="pb-4 px-4">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentDownloads as $download)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-800">{{ $download->user_name }}</span>
                                <span class="text-xs font-medium text-blue-500">Downloads: {{ $download->phone_no }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded-lg">
                                {{ $download->user_id }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm text-gray-700 font-medium">{{ $download->project_name }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-xs text-gray-400">
                                {{ $download->created_at->diffForHumans() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400 italic">No downloads recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</main>
</div>
</div>
</body>

</html>