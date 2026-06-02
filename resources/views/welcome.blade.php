@include('headerfooter.boiler')

<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">

@include('headerfooter.header')

<main class="flex-grow">


    {{-- ================= HERO SECTION WITH AI IMAGE BACKGROUND ================= --}}
    <section class="relative w-full h-[450px] overflow-hidden">

        {{-- AI Background Image --}}
        <img 
            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1600&q=80"
            class="absolute inset-0 w-full h-full object-cover opacity-50 z-0"
            alt="AI Background"
        >

        {{-- Overlay Content --}}
        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center 
            text-center px-4 animate-fadeIn">

            <h1 class="text-5xl font-extrabold drop-shadow-xl text-white tracking-wide">
                Welcome to AI solutions
            </h1>

            <p class="mt-4 text-lg text-gray-300 max-w-2xl">
                Discover powerful tools, AI-driven insights, quality services, and more.
            </p>

            <div class="mt-6 flex gap-4">
                <a href="/services" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 
                    transition text-white font-semibold shadow-lg">
                    View Services
                </a>

                <a href="/contact" class="px-6 py-3 rounded-xl bg-gray-800 hover:bg-gray-700 
                    transition text-white font-semibold shadow-lg">
                    Contact Us
                </a>
            </div>
        </div>

    </section>


    <style>
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 1.2s ease-out forwards; }
    </style>



    {{-- ================= FEATURE CARDS ================= --}}
    <section class="py-16 px-6 max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-center">What We Offer</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Card 1 --}}
            <div class="bg-[#1b2233] border border-[#2a3145] p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=800&q=80"
                    alt="Services" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-xl font-semibold mb-2">Our Services</h3>
                <p class="text-[#b9c3d6] text-sm">
                    High-quality, reliable services tailored to meet your needs.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-[#1b2233] border border-[#2a3145] p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80"
                    alt="Gallery" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-xl font-semibold mb-2">Gallery</h3>
                <p class="text-[#b9c3d6] text-sm">
                    Browse our collection of images and recent project highlights.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-[#1b2233] border border-[#2a3145] p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=800&q=80"
                    alt="Articles" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-xl font-semibold mb-2">Articles</h3>
                <p class="text-[#b9c3d6] text-sm">
                    Read helpful articles, tips, and insights curated just for you.
                </p>
            </div>

        </div>
    </section>



    {{-- ================= TESTIMONIAL SLIDER ================= --}}
    <section class="py-24 bg-[#111827]">
        <h2 class="text-3xl font-bold text-center mb-12">What Our Clients Say</h2>

        <div class="swiper max-w-3xl mx-auto px-6">

            <div class="swiper-wrapper">

                {{-- Testimonial 1 --}}
                <div class="swiper-slide bg-[#1b2233] border border-[#2a3145] p-8 py-20 rounded-xl shadow-md">
                    <p class="text-gray-300 text-lg mb-4">
                        “Amazing service! Truly professional and very reliable.”
                    </p>
                    <h4 class="text-white font-semibold">— Emily Carter</h4>
                </div>

                {{-- Testimonial 2 --}}
                <div class="swiper-slide bg-[#1b2233] border border-[#2a3145] p-8 py-20 rounded-xl shadow-md">
                    <p class="text-gray-300 text-lg mb-4">
                        “Their work exceeded my expectations. Highly recommended!”
                    </p>
                    <h4 class="text-white font-semibold">— John Michael</h4>
                </div>

                {{-- Testimonial 3 --}}
                <div class="swiper-slide bg-[#1b2233] border border-[#2a3145] p-8 py-20 rounded-xl shadow-md">
                    <p class="text-gray-300 text-lg mb-4">
                        “The support team is fantastic and always ready to help.”
                    </p>
                    <h4 class="text-white font-semibold">— Sarah Williams</h4>
                </div>

            </div>

            <div class="swiper-pagination mt-6"></div>

        </div>
    </section>

    <script>
        new Swiper('.swiper', {
            loop: true,
            autoplay: { delay: 3000 },
            pagination: { el: '.swiper-pagination', clickable: true },
        });
    </script>



    {{-- ================= CALL TO ACTION ================= --}}
    <section class="mt-10 mb-20">
        <div class="max-w-5xl mx-auto text-center bg-[#1d2433] border border-[#2a3145] rounded-2xl py-14 px-6 shadow-xl">
            <h2 class="text-3xl font-bold">Ready to Get Started?</h2>
            <p class="mt-3 text-[#b8c2d8] text-lg">
                Contact us today and let’s work together on your next project.
            </p>

            <a href="/contact" class="mt-6 inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold shadow-lg transition">
                Contact Us
            </a>
        </div>
    </section>

</main>

@include('components.chatbot')

@include('headerfooter.footer')

</body>
</html>
