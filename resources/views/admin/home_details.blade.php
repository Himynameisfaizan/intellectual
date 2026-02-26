@include('include.admin_header')

<div class="max-w-6xl mx-auto space-y-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-[#003366] px-6 py-4 flex items-center gap-2">
            <i class="ri-add-circle-line text-white text-xl"></i>
            <h2 class="text-white font-bold text-lg">Insert New Project Data</h2>
        </div>
        <form action="{{ route('insert') }}" method="post" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Approved Project Name</label>
                    <input required name="approved_project" type="text" placeholder="e.g. Website Redesign"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Project Password</label>
                    <input required name="password" type="text" placeholder="Access Password"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">User ID</label>
                    <input required name="user_id" type="text" placeholder="User Reference ID"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">PDF File</label>
                    <input required name="pdf" type="file"
                        class="w-full border border-gray-200 p-2 rounded-xl bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Banner Image (Optional)</label>
                    <input name="imageUpload" type="file"
                        class="w-full border border-gray-200 p-2 rounded-xl bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-gray-200 file:text-gray-700">
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-[#003366] text-white px-10 py-3 rounded-xl font-bold hover:bg-[#0c3863] transition shadow-lg flex items-center gap-2 cursor-pointer active:scale-95">
                    <i class="ri-save-line"></i> Insert Data
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-gray-800 text-lg">Recently Added Data</h2>
            <span class="bg-blue-50 text-[#003366] text-xs font-bold px-3 py-1 rounded-full uppercase">Total: {{ $details->count() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 uppercase text-[11px] font-bold text-gray-400">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Project Details</th>
                        <th class="px-6 py-4">Preview</th>
                        <th class="px-6 py-4">Document</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($details as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                        <td class="px-6 py-4 text-xs font-medium text-gray-500 whitespace-nowrap">{{ $item->created_at->format('d M, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800 text-sm uppercase leading-tight">{{ $item->approved_projects }}</div>
                            <div class="text-[10px] text-gray-400 mt-1">UI: {{ $item->user_id }} | PASS: {{ $item->password }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->image_url)
                            <img src="{{ asset($item->image_url) }}" class="w-12 h-12 rounded-xl object-cover">
                            @else
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center italic text-gray-300">N/A</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ asset($item->pdf) }}" target="_blank" class="text-red-500 flex items-center gap-1 font-bold text-[11px] uppercase">
                                <i class="ri-file-pdf-2-fill text-xl"></i> View PDF
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('home_details_edit_page' ,$item->id) }}" class="text-blue-500 hover:scale-110"><i class="ri-edit-2-line text-lg"></i></a>
                                <button onclick="showDeletePopup({{ $item->id }})" class="text-red-400 hover:text-red-600 hover:scale-110"><i class="ri-delete-bin-line text-lg"></i></button>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('delete_detail', $item->id) }}" method="POST" class="hidden">
                        @csrf @method('DELETE')
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    function confirmLogout() {
        if (confirm("Are you really want to logout?")) {
            document.getElementById('logout-form').submit();
        }
    }

    function showDeletePopup(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

</main>
</div>
</div>
</body>

</html>