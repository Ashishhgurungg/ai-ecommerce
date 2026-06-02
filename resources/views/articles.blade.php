@php $pageTitle = 'Knowledge Base Articles — AI Studio'; @endphp
@include('headerfooter.boiler')
@include('headerfooter.header')

{{-- Alpine.js Interface Runtime Engine --}}
<script src="https://unpkg.com/alpinejs" defer></script>

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 animate-in fade-in duration-300">

    {{-- Section Architecture Header Block --}}
    <header class="text-center max-w-xl mx-auto mb-12">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Knowledge Base
        </span>
        <h1 class="font-display text-3xl sm:text-4xl font-800 text-slate-900 dark:text-white tracking-tight">
            Articles & Insights
        </h1>
        <p class="mt-2 text-[14px] text-slate-500 dark:text-slate-400 leading-relaxed">
            Deep dives into automated workflows, enterprise application deployment notes, and core systemic architecture logs.
        </p>
    </header>

    {{-- Articles Grid Matrix --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        @forelse ($articles ?? [] as $article)
            <article class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                
                <div>
                    {{-- Article Preview Frame Asset --}}
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-4 relative bg-slate-100 dark:bg-slate-800/50">
                        @if ($article->image_path && file_exists(storage_path('app/public/articles/' . $article->image_path)))
                            <img 
                                src="{{ asset('storage/articles/' . $article->image_path) }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                            >
                        @else
                            <img 
                                src="{{ asset('images/default.jpg') }}"
                                alt="No presentation visual allocated"
                                class="w-full h-full object-cover opacity-80 mix-blend-normal dark:opacity-40"
                            >
                        @endif
                    </div>

                    {{-- Title String Header --}}
                    <h2 class="text-[17px] font-700 text-slate-900 dark:text-slate-100 tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                        {{ $article->title }}
                    </h2>

                    {{-- Dynamic Summary Context Handler Stack --}}
                    <div x-data="{ expanded: false }" class="mt-2 mb-4">
                        <p class="text-[13px] text-slate-500 dark:text-slate-400 leading-relaxed">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 130, '...') }}
                            </span>

                            <span x-show="expanded" x-cloak class="block prose prose-sm dark:prose-invert max-w-none text-[13px]">
                                {!! $article->description !!}
                            </span>
                        </p>

                        <button
                            class="text-[12px] font-600 text-blue-600 dark:text-blue-400 mt-1 hover:underline focus:outline-none"
                            @click="expanded = !expanded"
                            x-text="expanded ? 'Collapse Abstract' : 'Expand Abstract'">
                        </button>
                    </div>
                </div>

                {{-- Action Pipeline Operational Module (Cleaned Link Semantics) --}}
                <div class="border-t border-slate-100 dark:border-slate-800/80 pt-4 mt-2">
                    <a href="{{ url('/article/' . $article->id) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200/80 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-[13px] font-600 rounded-xl transition-all shadow-sm">
                        Read Full Manifest
                    </a>
                </div>

            </article>
        @empty
            <div class="col-span-full text-center bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 p-6 rounded-xl font-500 text-[14px]">
                <i class="fa-solid fa-newspaper block text-2xl mb-2 opacity-80"></i>
                {{ $message ?? 'No technical articles indexable inside current directory nodes.' }}
            </div>
        @endforelse

    </div>

    {{-- System Core Target Pagination Interface --}}
    @if(method_exists($articles, 'links'))
        <div class="mt-12 flex justify-center">
            {{ $articles->links() }}
        </div>
    @endif

</main>

@include('headerfooter.footer')