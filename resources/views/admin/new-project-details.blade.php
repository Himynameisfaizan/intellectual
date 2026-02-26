@include('include.admin_header')

<div class="max-w-6xl mx-auto space-y-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-[#003366] px-6 py-4 flex items-center gap-2">
            <i class="ri-add-circle-line text-white text-xl"></i>
            <h2 class="text-white font-bold text-lg">Insert New Project Data</h2>
        </div>

        <form action="{{ route('new_project_insert') }}" method="post" class="p-6">
            @csrf
            <div class="flex flex-col md:flex-row items-end justify-between gap-5">
                <div class="w-full flex-1 space-y-1">
                    <label class="text-sm font-semibold text-gray-700">New Project Name</label>
                    <input required name="new_update" type="text" placeholder="e.g. Website Redesign"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full bg-[#003366] text-white px-8 py-3.5 rounded-xl font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                        <i class="ri-save-line"></i> Insert Data
                    </button>
                </div>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-gray-800 text-lg tracking-tight">Recently Added Data</h2>
            <span class="bg-blue-50 text-[#003366] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Total: {{ $details->count() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 uppercase text-[11px] font-bold text-gray-400">
                    <tr>
                        <th class="px-6 py-4 tracking-wider">Date</th>
                        <th class="px-6 py-4 tracking-wider">Project Name</th>
                        <th class="px-6 py-4 tracking-wider text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($details as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                        <td class="px-6 py-4 text-xs font-medium text-gray-500 whitespace-nowrap">
                            {{ $item->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-700 uppercase">
                            {{ $item->new_update }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('new_project_edit' ,$item->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                    <i class="ri-edit-2-line text-lg"></i>
                                </a>
                                <button onclick="showDeletePopup({{ $item->id }})" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('new_project_delete', $item->id) }}" method="POST" class="hidden">
                        @csrf @method('DELETE')
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    function showDeletePopup(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003366',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl px-6 py-3',
                cancelButton: 'rounded-xl px-6 py-3'
            }
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