@php $pageTitle = 'Operational Vision & Blueprint — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

<main class="flex-grow max-w-5xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Corporate Blueprint
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            About Our Matrix Systems
        </h1>
        <p class="mt-2 text-[14px] text-slate-500 dark:text-slate-400 leading-relaxed">
            We are an automation engineering team dedicated to embedding context-aware intelligence, conversational routing layers, and robust data models into modern applications.
        </p>
    </header>

    {{-- Main Column Context Layout Stack --}}
    <div class="space-y-8">

        {{-- Row Component Block: Split Vision Architecture --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Who We Are Module --}}
            <article class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 rounded-2xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight mb-2">Who We Are</h2>
                    <p class="text-[13.5px] text-slate-500 dark:text-slate-400 leading-relaxed">
                        We are a focused collective of AI software engineers, data processing architects, and interaction engineers. Our framework implementations make powerful open-source models and intelligent pipeline processes accessible to standard operational environments.
                    </p>
                </div>
            </article>

            {{-- Our Mission Module --}}
            <article class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 rounded-2xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight mb-2">Our Mission</h2>
                    <p class="text-[13.5px] text-slate-500 dark:text-slate-400 leading-relaxed">
                        To empower running software instances with automated logic layers that perform repetitive tasks flawlessly, optimize end-user engagement parameters, and decrease computing latency — mapping theory directly to stable runtime configurations.
                    </p>
                </div>
            </article>
        </div>

        {{-- Core Matrix Capabilities Index --}}
        <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 sm:p-8 rounded-2xl shadow-sm">
            <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight mb-6 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-blue-600 dark:bg-blue-400 rounded-full"></span>
                Operational Capabilities (What We Do)
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Context-aware custom conversational agents for dynamic web applications.</span>
                </div>
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Autonomous support desk automated routing and ticketing automation.</span>
                </div>
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Workflow automation tools optimized for database and API transactions.</span>
                </div>
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Isolated private instance assistants deployed on company server nodes.</span>
                </div>
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Machine learning regression and prediction matrices for complex analytics.</span>
                </div>
                <div class="flex items-start gap-3 text-[13.5px] text-slate-600 dark:text-slate-400">
                    <span class="text-blue-600 dark:text-blue-400 mt-0.5">&bull;</span>
                    <span>Custom structural architecture integration for legacy enterprise codebases.</span>
                </div>
            </div>
        </section>

        {{-- Competitive Metrics Value Stack --}}
        <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-6 sm:p-8 rounded-2xl shadow-sm">
            <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight mb-6 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-blue-600 dark:bg-blue-400 rounded-full"></span>
                Architecture Benchmarks (Why Choose Us)
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60">
                    <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100 mb-1">Production-Grade Quality</h3>
                    <p class="text-[12.5px] text-slate-500 dark:text-slate-400 leading-relaxed">Clean code architectures complying with strict PSR standards and security filters.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60">
                    <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100 mb-1">Accelerated Deployment</h3>
                    <p class="text-[12.5px] text-slate-500 dark:text-slate-400 leading-relaxed">Rapid engineering sprint cycles backed by ongoing documentation updates.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60">
                    <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100 mb-1">Resource Optimization</h3>
                    <p class="text-[12.5px] text-slate-500 dark:text-slate-400 leading-relaxed">Cost-efficient API throttling configurations and efficient processing limits.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60">
                    <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100 mb-1">Tailored Adaptability</h3>
                    <p class="text-[12.5px] text-slate-500 dark:text-slate-400 leading-relaxed">Tailor-fit parameter configurations adjustments matching your direct technical guidelines.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60">
                    <h3 class="text-[14px] font-600 text-slate-900 dark:text-slate-100 mb-1">Zero-Leak Privacy</h3>
                    <p class="text-[12.5px] text-slate-500 dark:text-slate-400 leading-relaxed">Standardized cryptographic data isolation, preventing external model pooling pipelines.</p>
                </div>
            </div>
        </section>

        {{-- Long-Term System Vision Module --}}
        <footer class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 sm:p-8 rounded-2xl shadow-sm text-white">
            <h2 class="text-[17px] font-700 tracking-tight mb-2">Our Long-Term System Vision</h2>
            <p class="text-[13.5px] opacity-90 leading-relaxed max-w-3xl">
                We assert that computing automation models are engineered to amplify human productivity metrics — not completely displace the underlying operators. We visualize structural configurations where software clusters and human operators integrate fluidly, elevating real-world task output without stripping away necessary human validation and overview loops.
            </p>
        </footer>

    </div>
</main>

@include('headerfooter.footer')