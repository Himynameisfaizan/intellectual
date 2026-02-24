<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body">
    @include('include.admin_header')

    <div class="absolute top-20 left-70 z-10 w-[75%]">

        <main class="px-6">
            <div class="max-w-6xl mx-auto space-y-8">

                <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-[#003366] px-6 py-4">
                        <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                            <i class="ri-add-circle-line"></i> Insert New Project Data
                        </h2>
                    </div>

                    <form action="{{ route('insert') }}" method="post" enctype="multipart/form-data" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700">Approved Project Name</label>
                            <input required name="approved_project" type="text" placeholder="e.g. Website Redesign"
                                class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700">Project Password</label>
                            <input required name="password" type="text" placeholder="Access Password"
                                class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700">User ID</label>
                            <input required name="user_id" type="text" placeholder="User Reference ID"
                                class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700">PDF File</label>
                            <input required name="pdf" type="file"
                                class="w-full border border-gray-300 p-2 rounded-lg file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="space-y-1 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700">Banner/Project Image (Optional)</label>
                            <input name="imageUpload" type="file"
                                class="w-full border border-gray-300 p-2 rounded-lg file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="bg-[#003366] cursor-pointer text-white px-8 py-3 rounded-lg font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center gap-2">
                                <i class="ri-save-line"></i> Insert Data
                            </button>
                        </div>
                    </form>
                </section>

                <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="font-bold text-gray-800 text-lg">Recently Added Data</h2>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full uppercase tracking-wider">Total: {{ $details->count() }}</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Project</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">PDF</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Edit</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($details as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-600"> {{ $item->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-800">{{ $item->approved_projects }}</div>
                                        <div class="text-xs flex items-center gap-8 text-gray-400">
                                            <div>
                                                UI: {{ $item->user_id }}
                                            </div>
                                            <div class="text-xs text-gray-400">PASS: {{ $item->password }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($item->image_url)
                                        <img src="{{ asset($item->image_url) }}" class="w-12 h-12 rounded object-cover border border-gray-200">
                                        @else
                                        <span class="text-gray-400 text-xs italic">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset($item->pdf) }}" target="_blank" class="text-red-500 hover:text-red-700 flex items-center gap-1 font-medium text-sm">
                                            <i class="ri-file-pdf-2-fill text-lg"></i> View PDF
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('home_details_edit_page' ,$item->id) }}" class="text-blue-500 hover:text-blue-700 underline">
                                            <i class="ri-edit-2-line"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('delete_detail', $item->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" onclick="showDeletePopup({{ $item->id }})"
                                            class="text-red-500 hover:text-red-700 flex items-center gap-1 font-medium underline cursor-pointer">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        function showDeletePopup(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#003366', // Aapki theme ka color
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                position: 'top-end',
                toast: false, 
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
    </script>
    </body>

</html>