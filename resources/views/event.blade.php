@php $pageTitle = 'Upcoming Events Matrix — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

{{-- Alpine.js Interface Runtime Engine --}}
<script src="https://unpkg.com/alpinejs" defer></script>

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- System Core Block Header Section --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[15px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Event Catalog
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Upcoming Events
        </h1>
        <p class="mt-2 text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
            Explore our curated selection of upcoming events, workshops, and sessions designed to empower your AI journey. Whether you're looking to deepen your knowledge, connect with industry experts, or discover the latest trends, our event catalog has something for everyone. Join us and be part of the future of AI innovation.
        </p>
    </header>

    {{-- Events Grid Directory Cluster --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        @forelse ($events ?? [] as $event)
            <article class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                
                <div>
                    {{-- Graphic Context Node Wrapper --}}
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800/50">
                        @if ($event->image_path && file_exists(storage_path('app/public/events/' . $event->image_path)))
                            <img 
                                src="{{ asset('storage/events/' . $event->image_path) }}"
                                alt="{{ $event->title }} Context Image"
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                            >
                        @else
                            <img 
                                src="{{ asset('images/default.jpg') }}"
                                alt="No configuration visual variant allocated"
                                class="w-full h-full object-cover opacity-80 mix-blend-normal dark:opacity-40"
                            >
                        @endif
                    </div>

                    {{-- Title Anchor Module --}}
                    <h2 class="text-[20px] font-700 text-slate-900 dark:text-slate-100 tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $event->name }}
                    </h2>
                    <span class="text-[18px] font-700 text-emerald-600 dark:text-emerald-400 shrink-0 font-display">
                            {{ (float)$event->price > 0 ? '$' . number_format($event->price, 2) : 'Free' }}
                    </span>

                    {{-- Alpine.js Component Description Handler Stack --}}
                    <div x-data="{ expanded: false }" class="mt-2 mb-4">
                        <p class="text-[16px] text-slate-600 dark:text-slate-300 leading-relaxed">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 130, '...') }}
                            </span>

                            <span x-show="expanded" x-cloak class="block prose prose-sm dark:prose-invert max-w-none text-[16px]">
                                {!! $event->description !!}
                            </span>
                        </p>
<!-- 
                        <button
                            class="text-[14px] font-600 text-blue-600 dark:text-blue-400 mt-1 hover:underline focus:outline-none"
                            @click="expanded = !expanded"
                            x-text="expanded ? 'Collapse Description' : 'Expand Details'">
                        </button> -->
                    </div>
                </div>

                {{-- Action Pipeline Operational Module --}}
                <div class="border-t border-slate-100 dark:border-slate-800/80 pt-4 mt-2">
                    <a href="{{ url('/event/details/' . $event->id) }}" 
                       class="w-full flex items-center justify-center px-4 py-4 bg-slate-900 hover:bg-slate-800 dark:bg-slate-100 dark:hover:bg-white text-white dark:text-slate-900 text-[16px] font-600 rounded-xl transition-all shadow-sm">
                        View Event Details and Register
                    </a>
                </div>

            </article>
        @empty
            <div class="col-span-full text-center bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 p-6 rounded-xl font-500 text-[14px]">
                <i class="fa-solid fa-calendar-xmark block text-2xl mb-2 opacity-80"></i>
                {{ $message ?? 'No operational event configurations found within current repository cluster matrix.' }}
            </div>
        @endforelse

    </div>

    {{-- System Core Target Pagination Interface --}}
    @if(method_exists($events, 'links'))
        <div class="mt-12 flex justify-center">
            {{ $events->links() }}
        </div>
    @endif

    {{-- ================= ARCHIVED ARCHITECTURES SECTION ================= --}}
    <section class="max-w-4xl mx-auto mt-20 border-t border-slate-200 dark:border-slate-800/80 pt-12">
        <div class="text-center bg-slate-50 dark:bg-slate-900/40 border border-slate-200/60 dark:border-slate-800/60 rounded-2xl p-8">
            <h2 class="text-[20px] font-700 text-slate-900 dark:text-slate-100 tracking-tight">
                Looking for Completed Events?
            </h2>
            <p class="text-[16px] text-slate-600 dark:text-slate-300 mt-1 max-w-md mx-auto leading-relaxed">
                Historical documentation updates, logs, and capture imagery arrays from past event instances are here.
            </p>
            <div class="mt-4">
                <a href="{{ url('/galleries') }}" class="inline-flex items-center gap-1.5 text-[16px] font-600 text-blue-600 dark:text-blue-400 hover:underline">
                    Browse Systems Repositories <span class="tracking-normal">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</main>

@include('components.chatbot')
@include('headerfooter.footer')