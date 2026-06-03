@php $pageTitle = 'Home — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow animate-in fade-in duration-300">

    {{-- ================= HERO SECTION WITH RADIAL OVERLAY ================= --}}
    <section class="relative w-full h-[520px] flex items-center justify-center bg-slate-950 overflow-hidden">
        
        {{-- High-Fidelity Background Asset Media --}}
        <img 
            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1600&q=80"
            class="absolute inset-0 w-full h-full object-cover opacity-35 select-none pointer-events-none scale-105"
            alt="AI Architecture Context Grid"
        >
        
        {{-- Cinematic Radial Vignette Contrast Mask --}}
        <div class="absolute inset-0 bg-radial-vignette from-transparent to-slate-950/90 pointer-events-none"></div>

        {{-- Dynamic Interactive Landing Typography Row --}}
        <div class="relative z-10 text-center px-6 max-w-3xl mx-auto flex flex-col items-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[16px] font-700 tracking-wider text-blue-300 uppercase bg-blue-500/10 border border-blue-500/20 mb-5">
                Next-Gen Operational Frameworks
            </span>
            
            <h1 class="font-display text-4xl sm:text-6xl lg:text-6xl font-800 text-white tracking-tight drop-shadow-sm max-w-2xl leading-[1.1]">
                Welcome to AI Solutions
            </h1>

            <p class="mt-4 text-[18px] sm:text-[17px] text-slate-300 dark:text-slate-400 leading-relaxed font-400 max-w-xl">
                Discover powerful core orchestration tools, automated data models, and enterprise-grade infrastructure components.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/services') }}" class="px-6 py-3 text-[18px] font-600 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-lg shadow-blue-600/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    View Services
                </a>
                <a href="{{ url('/contact') }}" class="px-6 py-3 text-[18px] font-600 bg-slate-900/80 hover:bg-slate-800 text-slate-200 rounded-xl border border-slate-800 hover:scale-[1.02] active:scale-[0.98] transition-all backdrop-blur-sm">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    {{-- ================= METADATA STRUCTURAL FEATURE GRID ================= --}}
    <section class="py-20 px-6 max-w-7xl mx-auto">
        <div class="text-center max-w-xl mx-auto mb-12">
            <h2 class="font-display text-[26px] sm:text-4xl font-700 text-slate-900 dark:text-slate-100 tracking-tight">
                What We Offer
            </h2>
            <p class="text-[18px] text-slate-600 dark:text-slate-300 mt-2">
                Engineered system components configured for deployment out of the box.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

            {{-- Feature Card 1 --}}
            <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800">
                        <img src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=800&q=80"
                             alt="Services Matrix Content" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="text-[18px] font-600 text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        Core Services
                    </h3>
                    <p class="text-[18px] text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                        High-quality, reliable structural operational pipelines meticulously tailored to scale dynamically.
                    </p>
                </div>
                <a href="{{ url('/services') }}" class="inline-flex items-center gap-1 text-[12px] font-600 text-blue-600 dark:text-blue-400 mt-4 group-hover:translate-x-0.5 transition-transform">
                    Explore Services &rarr;
                </a>
            </div>

            {{-- Feature Card 2 --}}
            <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800">
                        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80"
                             alt="Gallery Presentation Visuals" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="text-[18px] font-600 text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        Media Repositories
                    </h3>
                    <p class="text-[18px] text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                        Browse our automated data arrays, image assets, and recent modular engineering framework highlights.
                    </p>
                </div>
                <a href="{{ url('/galleries') }}" class="inline-flex items-center gap-1 text-[12px] font-600 text-blue-600 dark:text-blue-400 mt-4 group-hover:translate-x-0.5 transition-transform">
                    Launch Gallery &rarr;
                </a>
            </div>

            {{-- Feature Card 3 --}}
            <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800">
                        <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=800&q=80"
                             alt="Technical Documentation Feed" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="text-[18px] font-600 text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        Knowledge Bases
                    </h3>
                    <p class="text-[18px] text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                        Read architectural briefs, whitepapers, structural updates, and operational analytics logs.
                    </p>
                </div>
                <a href="{{ url('/articles') }}" class="inline-flex items-center gap-1 text-[12px] font-600 text-blue-600 dark:text-blue-400 mt-4 group-hover:translate-x-0.5 transition-transform">
                    Read Blogs &rarr;
                </a>
            </div>

        </div>
    </section>

    {{-- ================= CLIENT TESTIMONIAL CAROUSEL SLIDER ================= --}}
    <section class="py-20 bg-slate-100 dark:bg-slate-900/40 border-y border-slate-200 dark:border-slate-800/60">
        <div class="text-center max-w-xl mx-auto mb-12 px-6">
            <h2 class="font-display text-[26px] sm:text-4xl font-700 text-slate-900 dark:text-slate-100 tracking-tight">
                Customer Feedbacks
            </h2>
            <p class="text-[16px] text-slate-600 dark:text-slate-300 mt-1">
                Real feedback from production environment evaluations.
            </p>
        </div>

        {{-- Swiper System Housing Container --}}
        <div class="swiper max-w-3xl mx-auto px-6 pb-12">
            <div class="swiper-wrapper">

                {{-- Slide Unit 1 --}}
                <div class="swiper-slide bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-8 sm:p-10 rounded-2xl shadow-sm text-center">
                    <span class="text-3xl text-blue-500 font-serif leading-none block mb-3">“</span>
                    <p class="text-[18px] sm:text-[20px] font-500 text-slate-700 dark:text-slate-300 italic max-w-xl mx-auto leading-relaxed">
                        Amazing service integration protocols! Truly professional response arrays and absolutely seamless delivery architectures.
                    </p>
                    <div class="w-8 h-px bg-slate-200 dark:bg-slate-800 mx-auto my-4"></div>
                    <h4 class="text-[16px] font-700 text-slate-900 dark:text-slate-200 uppercase tracking-wider">— Emily Carter</h4>
                </div>

                {{-- Slide Unit 2 --}}
                <div class="swiper-slide bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-8 sm:p-10 rounded-2xl shadow-sm text-center">
                    <span class="text-3xl text-blue-500 font-serif leading-none block mb-3">“</span>
                    <p class="text-[18px] sm:text-[20px] font-500 text-slate-700 dark:text-slate-300 italic max-w-xl mx-auto leading-relaxed">
                        Their modular deliverables exceeded standard benchmarks completely. Highly recommended engineering framework patterns.
                    </p>
                    <div class="w-8 h-px bg-slate-200 dark:bg-slate-800 mx-auto my-4"></div>
                    <h4 class="text-[13px] font-700 text-slate-900 dark:text-slate-200 uppercase tracking-wider">— John Michael</h4>
                </div>

                {{-- Slide Unit 3 --}}
                <div class="swiper-slide bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-8 sm:p-10 rounded-2xl shadow-sm text-center">
                    <span class="text-3xl text-blue-500 font-serif leading-none block mb-3">“</span>
                    <p class="text-[18px] sm:text-[20px] font-500 text-slate-700 dark:text-slate-300 italic max-w-xl mx-auto leading-relaxed">
                        The core infrastructure support desk remains fully operational and hyper-responsive across deployment cycles.
                    </p>
                    <div class="w-8 h-px bg-slate-200 dark:bg-slate-800 mx-auto my-4"></div>
                    <h4 class="text-[13px] font-700 text-slate-900 dark:text-slate-200 uppercase tracking-wider">— Sarah Williams</h4>
                </div>

            </div>

            {{-- Swiper Interactive Pagination Dots --}}
            <div class="swiper-pagination !-bottom-1"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper', {
                loop: true,
                spaceBetween: 24,
                autoplay: { 
                    delay: 4500,
                    disableOnInteraction: false 
                },
                pagination: { 
                    el: '.swiper-pagination', 
                    clickable: true 
                },
            });
        });
    </script>

    {{-- ================= INTERACTIVE CALL TO ACTION CONTAINER ================= --}}
    <section class="max-w-6xl mx-auto px-6 my-20">
        <div class="relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 sm:p-12 text-center shadow-sm overflow-hidden">
            <div class="absolute -right-16 -top-16 w-32 h-32 rounded-full bg-blue-600/5 blur-xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-32 h-32 rounded-full bg-blue-600/5 blur-xl pointer-events-none"></div>
            
            <h2 class="font-display text-[24px] sm:text-3xl font-700 text-slate-900 dark:text-slate-100 tracking-tight">
                Ready to Initialize Deployment?
            </h2>
            <p class="mt-2 text-[13.5px] sm:text-[16px] text-slate-500 dark:text-slate-400 max-w-md mx-auto leading-relaxed">
                Connect with an engineering specialist today to orchestrate your operational package targets.
            </p>

            <a href="{{ url('/contact') }}" class="mt-6 inline-block px-7 py-3 bg-blue-600 hover:bg-blue-700 text-white text-[13.5px] font-600 rounded-xl shadow-md shadow-blue-600/10 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Contact now &rarr;
            </a>
        </div>
    </section>

</main>

@include('components.chatbot')
@include('headerfooter.footer')