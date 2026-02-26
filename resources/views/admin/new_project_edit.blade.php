@include("include.admin_header")

<div class="max-w-4xl mx-auto space-y-6">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="bg-[#003366] px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/admin/new-project-details') }}" class="text-white/80 hover:text-white font-medium flex items-center gap-1 transition-all text-sm">
                <i class="ri-arrow-left-line"></i> Back to Projects
            </a>
            <h2 class="text-white text-lg font-bold flex items-center gap-2">
                <i class="ri-edit-circle-line"></i>
                Edit New Project
            </h2>
        </div>

        <form action="{{ route('new_project_update', $details->id) }}" method="post" class="p-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row items-end justify-between gap-5">
                <div class="w-full flex-1 space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <input required name="new_update" type="text" value="{{ $details->new_update }}"
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50">
                </div>

                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full bg-[#003366] text-white px-10 py-3.5 rounded-xl font-bold hover:bg-[#0c3863] active:scale-95 transition shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                        <i class="ri-save-line"></i> Update Data
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>

</main>
</div>
</div>
</body>

</html>