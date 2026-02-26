@include('include.admin_header')

<div class="max-w-4xl mx-auto ">
    <section id="projectDetail" class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="bg-[#003366] px-6 py-4">
            <h3 class="text-center font-bold text-white text-2xl flex items-center justify-center gap-2">
                <i class="ri-file-pdf-2-line"></i> Generate PDF
            </h3>
        </div>

        <form class="flex flex-col gap-6 px-8 py-10" action="{{ route('pdf.generate') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-1.5">
                    <label for="clientName" class="font-semibold text-sm text-gray-700">Client name<span class="text-rose-500">*</span></label>
                    <input type="text" id="clientName" name="client_name"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50"
                        placeholder="Mr. Shiva Kumar" required>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="company_name" class="font-semibold text-sm text-gray-700">Company name<span class="text-rose-500">*</span></label>
                    <input type="text" id="company_name" name="company_name"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50"
                        placeholder="e.g. Do it creation" required>
                </div>

                <div class="flex flex-col gap-1.5 md:col-span-2">
                    <label for="gst" class="font-semibold text-sm text-gray-700">CIN/GST number<span class="text-rose-500">*</span></label>
                    <input type="text" id="gst" name="gst_no"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50"
                        placeholder="e.g. U75000UP2025PTC221207" required>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="date" class="font-semibold text-sm text-gray-700">Date<span class="text-rose-500">*</span></label>
                    <input type="date" id="date" name="date"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50" required>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="logo" class="font-semibold text-sm text-gray-700">Company Logo<span class="text-rose-500">*</span></label>
                    <input type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg"
                        class="w-full border border-gray-300 rounded-xl py-2 px-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50 file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                </div>

                <div class="flex flex-col gap-1.5 md:col-span-2">
                    <label for="address" class="font-semibold text-sm text-gray-700">Address<span class="text-rose-500">*</span></label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50"
                        placeholder="Enter full address..."></textarea>
                </div>

                <div class="flex flex-col gap-1.5 md:col-span-2">
                    <label for="userPassword" class="font-semibold text-sm text-gray-700">Generate unique id<span class="text-rose-500">*</span></label>
                    <div class="flex gap-2">
                        <input readonly type="text" id="userPassword" name="userPassword"
                            class="flex-1 border border-gray-300 rounded-xl py-3 px-4 bg-gray-100 text-gray-500 font-mono outline-none"
                            placeholder="Click button to generate ID" required>
                        <button type="button" onclick="generateRandomString(10)"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 rounded-xl transition-all" title="Generate ID">
                            <i class="ri-refresh-line text-xl font-bold"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#003366] py-4 text-white rounded-xl font-bold text-lg active:scale-95 cursor-pointer hover:bg-[#0c3863] transition-all shadow-lg flex items-center justify-center gap-2 mt-4">
                <i class="ri-download-cloud-2-line"></i> Generate & Download PDF
            </button>
        </form>
    </section>
</div>

<script>
    function generateRandomString(length = 10) {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        const randomValues = new Uint8Array(length);
        window.crypto.getRandomValues(randomValues);

        let result = "it_";
        for (let i = 0; i < length; i++) {
            result += chars[randomValues[i] % chars.length];
        }

        document.getElementById('userPassword').value = result;
    }
</script>

</main>
</div>
</div>
</body>

</html>