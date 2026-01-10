<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intellectual</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('include.header')

    <style>
        @keyframes scrollUp {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        .animate-scroll-up {
            animation: scrollUp 15s linear infinite;
        }

        .animate-scroll-up:hover {
            animation-play-state: paused;
        }

        @keyframes move-rtl {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }

        }

        @keyframes move-ltr {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(100%);
            }

        }

        .bounce-text {
            display: inline-block;
            white-space: nowrap;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        .bounce-text:hover {
            animation-play-state: paused;
        }

        .scroll-container {
            overflow: hidden;
            width: 100%;
            position: relative;
        }
    </style>

    <section class="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12 mt-4 pt-[12vh]">
        <div class="flex flex-col lg:flex-row gap-8 h-auto py-5 lg:h-110">

            <div class="w-full lg:w-3/5 relative rounded-xl overflow-hidden shadow-2xl bg-gray-200 group aspect-video lg:aspect-auto">
                <div class="slider-track flex transition-transform duration-500 ease-out h-full" id="slider-track">
                    @foreach ($imagePaths as $mediaUrl)

                    {{-- Ab yaha check karne ki zaroorat nahi hai ki empty hai ya nahi,
             kyunki Controller ne pehle hi saaf kar diya hai --}}

                    @php
                    $extension = pathinfo($mediaUrl, PATHINFO_EXTENSION);
                    $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'avi', 'webm']);
                    @endphp

                    <div class="min-w-full h-full relative">
                        @if($isVideo)
                        <video class="w-full h-full object-cover" autoplay muted loop playsinline>
                            <source src="{{ $mediaUrl }}" type="video/{{ $extension }}">
                        </video>
                        @else
                        <img src="{{ $mediaUrl }}" alt="Slide" class="w-full h-full object-cover">
                        @endif
                    </div>

                    @endforeach
                </div>

                <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow-md z-10 transition">
                    <svg class="w-6 h-6 text-[#003366]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow-md z-10 transition">
                    <svg class="w-6 h-6 text-[#003366]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 6l6 6-6 6" />
                    </svg>
                </button>
            </div>

            <div class="w-full lg:w-2/5 border border-blue-900/20 rounded-xl bg-white shadow-lg overflow-hidden flex flex-col h-100 lg:h-auto">
                <div class="bg-white p-6 z-10 border-b shadow-sm">
                    <h4 class="text-xl font-bold text-[#003366]">Approved Projects</h4>
                    <div class="h-1 w-16 bg-blue-900 mt-2 rounded"></div>
                </div>

                <div class="relative grow overflow-hidden p-4">
                    <ul class="animate-scroll-up absolute w-full space-y-4 text-center pb-10">
                        @foreach ($pdfLastToOne as $project)
                        <li class="cursor-pointer hover:underline transition text-sm font-medium text-gray-700 flex justify-center items-center">
                            {{ $project->approved_projects }}
                            <span class="ml-2 bg-red-600 text-white text-[10px] px-1 rounded-sm uppercase font-bold tracking-wider">New</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 overflow-hidden">
            <h1 class="text-3xl font-bold text-[#003366] text-center mb-8 font-sans">New Updates</h1>
            <div class="relative max-w-6xl m-auto overflow-hidden">
                <div class="new-update-title whitespace-nowrap animate-scroll-left flex gap-2 items-center">
                    <div class="flex flex-col gap-4 w-full text-center overflow-hidden">
                        @foreach ($grouped as $chunk)
                        @php
                        $animationName = $loop->iteration % 2 == 0 ? 'move-ltr' : 'move-rtl';
                        $speed = rand(8, 10) . 's';
                        @endphp

                        <div class="scroll-container">
                            <div class="bounce-text"
                                style="animation-name: {{ $animationName }}; animation-duration: {{ $speed }};">

                                @foreach ($chunk as $item)
                                <span class="text-sm md:text-base cursor-pointer text-gray-800 hover:text-gray-500 font-medium px-2">
                                    {{ $item->approved_projects ?? $item->new_update ?? 'Update Title' }}
                                </span>

                                {{-- Separator (||) --}}
                                @if (!$loop->last)
                                <span class="mx-2 text-blue-900 font-bold">||</span>
                                @endif
                                @endforeach

                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-[#003366]">Legal Board Member</h1>
                <div class="h-1 w-24 bg-blue-900 mx-auto mt-3 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 justify-items-center">

                <div class="flex flex-col items-center gap-4 group">
                    <div class="w-48 h-48 rounded-full overflow-hidden cursor-pointer border-4 border-transparent group-hover:border-blue-900 transition duration-300 shadow-xl">
                        <img src="{{ asset('storage/images/Dheeraj.png') }}" alt="Dheeraj" class="w-full h-full object-cover">
                    </div>
                    <div class="text-center">
                        <h4 class="text-xl font-semibold text-gray-800">Mr. Dheeraj Bansal</h4>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-4 group">
                    <div class="w-48 h-48 rounded-full overflow-hidden cursor-pointer border-4 border-transparent group-hover:border-blue-900 transition duration-300 shadow-xl">
                        <img src="{{ asset('storage/images/Kabir.png') }}" alt="Kabir" class="w-full h-full object-cover">
                    </div>
                    <div class="text-center">
                        <h4 class="text-xl font-semibold text-gray-800">Mr. Kabir Upadhyay</h4>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-4 group">
                    <div class="w-48 h-48 rounded-full overflow-hidden cursor-pointer border-4 border-transparent group-hover:border-blue-900 transition duration-300 shadow-xl">
                        <img src="{{ asset('storage/images/Reetu.png') }}" alt="Reetu" class="w-full h-full object-cover">
                    </div>
                    <div class="text-center">
                        <h4 class="text-xl font-semibold text-gray-800">Mrs. Reetu Singhaniya</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-[#003366]">All Business Class Information</h2>
            </div>
            <div class="prose max-w-none text-gray-600 text-justify mb-8 leading-relaxed">
                <p>Protecting your brand and intellectual property is essential for long-term business success. One critical
                    step in this process is conducting a thorough trademark class search. Trademarks are valuable business assets
                    that provide legal protection and grant exclusive rights over your brand name, logo, or slogan. Understanding
                    trademark classifications and conducting a proper trademark category analysis are key to successful trademark
                    registration and enforcement.</p>
            </div>

            <div class="space-y-4">
                <div class="bg-white border-b border-blue-900/20">
                    <button class="accordion-btn w-full flex justify-between items-center py-4 px-2 text-left focus:outline-none">
                        <h3 class="text-xl font-semibold text-[#003366]">What is a Trademark?</h3>
                        <i class="ri-arrow-down-s-fill text-2xl text-[#003366] transition-transform duration-300"></i>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-4 text-gray-700 text-justify">A trademark is a unique word, name, symbol, logo, or slogan that identifies and distinguishes the goods or
                            services of one party from those of others in the market. Trademarks play a vital role in brand recognition
                            and customer trust. When registered, a trademark offers legal protection against unauthorized use, allowing
                            the owner to prevent others from exploiting the mark without consent. Trademarks can consist of words,
                            phrases, symbols, designs, or a combination of these elements.</p>
                    </div>
                </div>

                <div class="bg-white border-b border-blue-900/20">
                    <button class="accordion-btn w-full flex justify-between items-center py-4 px-2 text-left focus:outline-none">
                        <h3 class="text-xl font-semibold text-[#003366]">What is a Trademark Class?</h3>
                        <i class="ri-arrow-down-s-fill text-2xl text-[#003366] transition-transform duration-300"></i>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-4 text-gray-700 text-justify">Trademarks are classified into various categories known as trademark classes, based on the nature of the
                            goods or services they represent. This classification system, called the Nice Classification, was
                            established by the World Intellectual Property Organization (WIPO). It divides goods and services into 45
                            distinct classes — 34 for goods and 11 for services. Properly identifying and assigning your trademark to
                            the correct class is essential for ensuring comprehensive legal protection and avoiding conflicts during the
                            registration process.</p>
                    </div>
                </div>

                <div class="bg-white border-b border-blue-900/20">
                    <button class="accordion-btn w-full flex justify-between items-center py-4 px-2 text-left focus:outline-none">
                        <h3 class="text-xl font-semibold text-[#003366]">Trademark class List</h3>
                        <i class="ri-arrow-down-s-fill text-2xl text-[#003366] transition-transform duration-300"></i>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-4 text-gray-700 text-justify">The trademark class list provides a structured framework for categorizing a broad range of goods and
                            services. This system is designed to simplify the trademark registration process and ensure clarity in
                            intellectual property rights. For businesses seeking to protect their brand, it is crucial to understand the
                            specifics of this classification system. Accurate classification helps ensure that trademarks are registered
                            appropriately and are well-protected against potential infringement.</p>
                    </div>
                </div>

                <div class="bg-white border-b border-blue-900/20">
                    <button class="accordion-btn w-full flex justify-between items-center py-4 px-2 text-left focus:outline-none">
                        <h3 class="text-xl font-semibold text-[#003366]">Trademark Classification List</h3>
                        <i class="ri-arrow-down-s-fill text-2xl text-[#003366] transition-transform duration-300"></i>
                    </button>
                    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-4 overflow-x-auto">
                            <table class="w-full min-w-150 text-left border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="p-3 border">Class</th>
                                        <th class="p-3 border">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class='p-3 border'>Trademark Class 1 </td>
                                        <td class='p-3 border'>Chemical used in industry, science, photography, agriculture, horticulture and forestry; unprocessed
                                            plastics; chemical substances for preserving foodstuffs;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 2 </td>
                                        <td class='p-3 border'>Paints; varnishes; preservatives against rust and against deterioration of wood; colorants; metals
                                            in
                                            foil and powder form for painters; decorators; printers and artists;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 3 </td>
                                        <td class='p-3 border'>Bleaching preparations and substances for laundry use; cleaning; polishing; abrasive preparations;
                                            soaps; perfumery, essential oils, cosmetics, hair lotions;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 4 </td>
                                        <td class='p-3 border'>Industrial oils and greases; lubricants; dust absorbing, wetting and binding compositions; fuels
                                            (including motor spirit) and illuminants; candles, wicks;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 5 </td>
                                        <td class='p-3 border'>Industrial oils and greases; lubricants; dust absorbing, wetting and binding compositions; fuels
                                            (including motor spirit) and illuminants; candles, wicks;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 6 </td>
                                        <td class='p-3 border'>Common metals and their alloys; metal building materials; small items of metal hardware; pipes and
                                            tubes of metal; goods of metal not included in other classes;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 7 </td>
                                        <td class='p-3 border'>Machines and machine tools; machine coupling and transmission components; agricultural implements
                                            other than hand-operated; incubators for eggs;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 8 </td>
                                        <td class='p-3 border'>Hand tools and implements (hand-operated); cutlery; side arms; razors
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 9</td>
                                        <td class='p-3 border'>Scientific, electric, photographicl, measuring, apparatus for recording, transmission or
                                            reproduction
                                            of sound or images; data processing equipment and computers;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 10 </td>
                                        <td class='p-3 border'>Surgical, medical, dental and veterinary apparatus and instruments, artificial limbs, eyes and
                                            teeth;
                                            orthopaedic articles; suture materials;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 11 </td>
                                        <td class='p-3 border'>Apparatus for lighting, heating, steam generating, cooking, refrigerating, drying ventilating, water
                                            supply and sanitary purposes
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 12</td>
                                        <td class='p-3 border'>Vehicles; apparatus for locomotion by land, air or water
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 13</td>
                                        <td class='p-3 border'>Firearms; ammunition and projectiles; explosives; fire work
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 14</td>
                                        <td class='p-3 border'>Precious metals and their alloys and goods in precious metals; jewellery, precious stones;
                                            horological
                                            and other chronometric instruments
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 15</td>
                                        <td class='p-3 border'>Musical instruments
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 16</td>
                                        <td class='p-3 border'>Paper, cardboard and goods made from these materials; printed matter; stationery; brushes;
                                            typewriters
                                            and office requisites; plastic materials for packaging;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 17</td>
                                        <td class='p-3 border'>Rubber, asbestos, mica and goods made from these materials; plastics in extruded form for use in
                                            manufacture; packing, stopping and insulating materials; flexible pipes;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 18</td>
                                        <td class='p-3 border'>Leather and imitations of leathe; animal skins, hides, trunks and travelling bags; umbrellas,
                                            parasols and walking sticks; whips, harness and saddlery;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 19</td>
                                        <td class='p-3 border'>Building materials, (non-metallic), non-metallic rigid pipes for building; asphalt, pitch and
                                            bitumen; non-metallic transportable buildings; monuments, not of metal.
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class='p-3 border'>Trademark Class 20</td>
                                        <td class='p-3 border'>Furniture, mirrors, picture frames; goods of wood, cork, reed, cane, wicker, horn, bone, ivory,
                                            whalebone, shell, amber, mother- of-pearl, meerschaum or of plastics
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 21 </td>
                                        <td class='p-3 border'>Household or kitchen utensils and containers; combs and sponges; articles for cleaning purposes;
                                            unworked or semi-worked glass; glassware and earthenware;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 22 </td>
                                        <td class='p-3 border'>Ropes, string, nets, tents, awnings, tarpaulins, sails, sacks and bags, padding and stuffing
                                            materials(except of rubber or plastics); raw fibrous textile materials
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 23</td>
                                        <td class='p-3 border'>Yarns and threads, for textile use
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 24</td>
                                        <td class='p-3 border'>Textiles and textile goods, not included in other classes; bed and table covers.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 25</td>
                                        <td class='p-3 border'>Clothing, footwear, headgear
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 26</td>
                                        <td class='p-3 border'>Lace and embroidery, ribbons and braid; buttons, hooks and eyes, pins and needles; artificial
                                            flowers
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 27</td>
                                        <td class='p-3 border'>Carpets, rugs, mats and matting, linoleum and other materials for covering existing floors; wall
                                            hangings(non-textile)
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 28</td>
                                        <td class='p-3 border'>Games and playthings, gymnastic and sporting articles not included in other classes; decorations for
                                            Christmas trees
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 29</td>
                                        <td class='p-3 border'>Meat, fish, poultry and game; meat extracts; preserved, dried and cooked fruits and vegetables;
                                            jams, fruit sauces; eggs, milk and milk products; edible oils and fats
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 30 </td>
                                        <td class='p-3 border'>Coffee, tea, cocoa, sugar, rice, tapioca, sago; bread, pastry and confectionery, ices; honey,
                                            treacle; yeast, baking powder; salt, mustard; vinegar; spices; ice
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 31 </td>
                                        <td class='p-3 border'>Agricultural, horticultural and forestry products and grains; live animals; fresh fruits and
                                            vegetables; seeds, natural plants and flowers; foodstuffs for animals, malt
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 32</td>
                                        <td class='p-3 border'>Beers, mineral and aerated waters, and other non-alcoholic drinks; fruit drinks and fruit juices;
                                            syrups and other preparations for making beverages
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 33</td>
                                        <td class='p-3 border'>Alcoholic beverages(except beers)
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 34 </td>
                                        <td class='p-3 border'>Tobacco, smokers' articles, matches
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 35 </td>
                                        <td class='p-3 border'>Advertising, business management, business administration, office functions.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class='p-3 border'>Trademark Class 36</td>
                                        <td class='p-3 border'>Insurance, financial affairs; monetary affairs; real estate affairs.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 37</td>
                                        <td class="p-3 border">Building construction; repair; installation services.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 38</td>
                                        <td class="p-3 border">Telecommunications.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 39 </td>
                                        <td class="p-3 border">Transport; packaging and storage of goods; travel arrangement.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 40 </td>
                                        <td class="p-3 border">Treatment of materials.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 41</td>
                                        <td class="p-3 border">Education; providing of training; entertainment; sporting and cultural activities.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 42</td>
                                        <td class="p-3 border">Scientific, design and technological services; industrial analysis and research services; design and
                                            development of computer hardware and software.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 43</td>
                                        <td class="p-3 border">Services for providing food and drink; temporary accommodation.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 44 </td>
                                        <td class="p-3 border">Medical services, veterinary services, hygienic and beauty care for human beings or animals;
                                            agriculture, horticulture and forestry services.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="p-3 border">Trademark Class 45 </td>
                                        <td class="p-3 border">Legal services; security services for the protection of property and individuals; personal and
                                            social services rendered by others to meet the needs of individuals.
                                        </td>
                                    </tr>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Slider Logic
            const track = document.getElementById('slider-track');
            if (track) {
                const slides = Array.from(track.children);
                const nextBtn = document.getElementById('nextBtn');
                const prevBtn = document.getElementById('prevBtn');
                let currentIndex = 0;

                function updateSlider() {
                    const slideWidth = slides[0].getBoundingClientRect().width;
                    track.style.transform = 'translateX(-' + (currentIndex * slideWidth) + 'px)';
                }

                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % slides.length;
                    updateSlider();
                });
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                    updateSlider();
                });

                setInterval(() => {
                    currentIndex = (currentIndex + 1) % slides.length;
                    updateSlider();
                }, 5000);
                window.addEventListener('resize', updateSlider);
            }

            // Accordion Logic
            const accordions = document.querySelectorAll('.accordion-btn');
            accordions.forEach(acc => {
                acc.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.classList.toggle('rotate-180');
                    const content = this.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>

    @include('include.footer')
</body>

</html>