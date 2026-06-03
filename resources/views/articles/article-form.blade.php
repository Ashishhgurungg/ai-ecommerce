@php $pageTitle = 'Create Article — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[850px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="mb-8">
        <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Add New Article</h1>
        <p class="text-[15px] text-slate-600 dark:text-slate-300 mt-1.5">Draft new articles, attach media assets, and publish content to your public feed.</p>
    </div>

    {{-- Form Context Workspace Card --}}
    <div class="bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
        
        {{-- Success Alerts --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
                <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors System --}}
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-950/30 border border-red-200/60 dark:border-red-900/40 text-red-800 dark:text-red-400 p-4 rounded-xl text-[13.5px] mb-6 shadow-sm">
                <div class="flex items-center gap-2 text-red-700 dark:text-red-400 font-600 mb-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>Please correct the processing exceptions:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-slate-600 dark:text-slate-400 font-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Resource Submission Form --}}
        <form action="{{ url('/article-form') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Article Title Input Component --}}
            <div>
                <label for="name" class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Article Title</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="e.g., Optimizing Vector Databases for Generative AI"
                       required
                       class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150">
            </div>

            {{-- Article Description Component --}}
            <div>
                <label for="description" class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Article Description</label>
                <textarea id="description"
                          name="description"
                          rows="6"
                          placeholder="Compose or paste your main article markdown contents here..."
                          required
                          class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150 resize-y">{{ old('description') }}</textarea>
            </div>

            {{-- Article Featured Cover Media Input --}}
            <div>
                <label class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-2">Featured Cover Image</label>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    {{-- Input Trigger Box --}}
                    <div class="md:col-span-2">
                        <div class="relative flex items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-5 bg-slate-50/40 dark:bg-slate-900/10 text-center">
                            <label for="image" class="cursor-pointer flex flex-col items-center group">
                                <span class="inline-flex items-center gap-2 px-3.5 py-2 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 text-[14px] font-600 rounded-xl shadow-sm group-hover:bg-slate-50 dark:group-hover:bg-slate-800 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Select Cover Art
                                </span>
                                <input type="file" id="image" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                        </div>
                    </div>

                    {{-- Staged Image Preview Window --}}
                    <div id="preview-wrapper" class="hidden aspect-video md:aspect-auto md:h-[74px] rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center relative">
                        <img id="article-preview" src="#" alt="Staged Preview" class="w-full h-full object-cover">
                        <button type="button" id="clear-preview-btn" class="absolute top-1 right-1 w-5 h-5 bg-slate-900/80 hover:bg-red-600 text-white rounded-md flex items-center justify-center transition-colors focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Submission Actions Panel --}}
            <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end">
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[14px] font-600 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer focus:outline-none">
                    Add Article
                </button>
            </div>

        </form>
    </div>
</main>

{{-- Live Input Preview Engine --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const previewWrapper = document.getElementById('preview-wrapper');
        const previewImg = document.getElementById('article-preview');
        const clearBtn = document.getElementById('clear-preview-btn');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                    previewWrapper.classList.remove('hidden');
                    previewWrapper.classList.add('animate-in', 'zoom-in-95', 'duration-150');
                }
                reader.readAsDataURL(file);
            }
        });

        clearBtn.addEventListener('click', function() {
            imageInput.value = '';
            previewImg.setAttribute('src', '#');
            previewWrapper.classList.add('hidden');
        });
    });
</script>

@include('layouts.footer')