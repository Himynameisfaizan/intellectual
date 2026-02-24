<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home details edit page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include("include.admin_header")
    <div class="absolute top-20 left-70 z-10 w-[75%]">

        <div class="px-6">
            <section class="rounded-xl overflow-hidden bg-white">
                <div class="bg-[#003366] px-6 py-4 flex items-center justify-between">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('home_details') }}" class="text-white font-medium flex items-center gap-1 hover:underline">
                            <i class="ri-arrow-left-line"></i> Back to Dashboard
                        </a>
                    </div>
                    <div>
                        <h2 class="text-white text-lg font-bold flex items-center gap-2">
                            <i class="ri-add-circle-line"></i>
                            Edit Project Data
                        </h2>
                    </div>
                </div>
                <div>
                    <form action="{{ route('new_project_update', $details->id) }}" method="post" class="p-6">
                        @csrf
                        @method('PUT')

                        <div class="flex items-end justify-between gap-5">
                            <div class="flex-1">
                                <label class="text-sm font-medium text-gray-700">New Project Name</label>
                                <input required name="new_update" type="text" value="{{ $details->new_update }}"
                                    class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                            </div>

                            <div class="">
                                <button type="submit" class="bg-[#003366] cursor-pointer text-white px-8 py-3 rounded-lg font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center gap-2">
                                    <i class="ri-save-line"></i> Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>


        </div>
    </div>
</body>

</html>