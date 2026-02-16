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
                    <form action="{{ route('update_detail', $details->id) }}" method="post" enctype="multipart/form-data" class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        @csrf
                        @method('PUT')

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700" for="">Approved Project Name</label>
                            <input type="text" required name="approved_project" value="{{ $details->approved_projects }}" placeholder="e.g. Do It Creation" class="border border-gray-300 w-full p-2 .5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700" for="">Project Password</label>
                            <input type="text" required name="password" value="{{ $details->password }}" placeholder="Change Project Password" class="border border-gray-300 w-full p-2 .5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700" for="">User ID</label>
                            <input type="text" required name="user_id" placeholder="Change User ID" value="{{ $details->user_id }}" class="border border-gray-300 w-full p-2 .5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-700" for="">PDF File</label>
                            <input type="file" name="pdf" placeholder="e.g. Do It Creation" class="border border-gray-300 w-full p-2 .5 rounded-lg file:cursor-pointer file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-700" for="">Banner/Project image (Optional)</label>
                            <input type="file" name="imageUpload" placeholder="e.g. Do It Creation" class="border border-gray-300 w-full p-2 .5 rounded-lg file:cursor-pointer file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="bg-[#003366] hover:bg-[#003366e8] text-white px-6 py-3 rounded-lg font-bold cursor-pointer active:scale-95 transition"><i class="ri-save-line"></i> Update Data</button>
                        </div>

                    </form>
                </div>
            </section>


        </div>
    </div>
</body>

</html>