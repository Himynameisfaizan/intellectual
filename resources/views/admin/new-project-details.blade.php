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

                    <form action="{{ route('new_project_insert') }}" method="post" class="p-6 gap-6">
                        @csrf
                        <div class="flex items-end justify-between gap-5">
                            <div class="flex-1">
                                <label class="text-sm font-medium text-gray-700">New Project Name</label>
                                <input required name="new_update" type="text" placeholder="e.g. Website Redesign"
                                    class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                            </div>

                            <div class="">
                                <button type="submit" class="bg-[#003366] cursor-pointer text-white px-8 py-3 rounded-lg font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center gap-2">
                                    <i class="ri-save-line"></i> Insert Data
                                </button>
                            </div>
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
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Edit</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($details as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-600"> {{ $item->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"> {{$item->new_update }}   </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('new_project_edit' ,$item->id) }}" class="text-blue-500 hover:text-blue-700 underline">
                                            <i class="ri-edit-2-line"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('new_project_delete', $item->id) }}" method="POST" class="hidden">
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
                confirmButtonColor: '#003366',
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