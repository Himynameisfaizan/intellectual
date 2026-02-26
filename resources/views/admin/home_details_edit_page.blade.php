@include("include.admin_header")

<div class="max-w-4xl mx-auto space-y-6">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="bg-[#003366] px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home_details') }}" class="text-white/80 hover:text-white font-medium flex items-center gap-1 transition-all text-sm">
                <i class="ri-arrow-left-line"></i> Back to List
            </a>
            <h2 class="text-white text-lg font-bold flex items-center gap-2">
                <i class="ri-edit-circle-line"></i>
                Edit Project Data
            </h2>
        </div>

        <form action="{{ route('update_detail', $details->id) }}" method="post" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Approved Project Name</label>
                    <input type="text" required name="approved_project" value="{{ $details->approved_projects }}"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Project Password</label>
                    <input type="text" required name="password" value="{{ $details->password }}"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">User ID</label>
                    <input type="text" required name="user_id" value="{{ $details->user_id }}"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">PDF File (Leave blank to keep current)</label>
                    <input type="file" name="pdf"
                        class="w-full border border-gray-200 p-2 rounded-xl bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Banner/Project image (Optional)</label>
                    <input type="file" name="imageUpload"
                        class="w-full border border-gray-200 p-2 rounded-xl bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700">
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-4">
                <a href="{{ route('home_details') }}" class="text-gray-500 font-semibold hover:text-gray-700 transition">Cancel</a>
                <button type="submit" class="bg-[#003366] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center gap-2 cursor-pointer">
                    <i class="ri-save-line"></i> Update Project
                </button>
            </div>
        </form>
    </section>
</div>

</main>
</div>
</div>
</body>

</html>