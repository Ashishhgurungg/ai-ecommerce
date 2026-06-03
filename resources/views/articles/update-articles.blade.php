@php $pageTitle = 'Edit Article — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[850px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="mb-8">
        <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Edit Article</h1>
        <p class="text-[15px] text-slate-600 dark:text-slate-300 mt-1.5">Modify text content, manage existing active assets, or stage alternative cover graphics.</p>
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
        <form action="{{ url('/update-articles') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="id" value="{{ $article->id }}">
            <input type="hidden" name="remove_image" id="remove_image_field" value="0">

            {{-- Article Title Input Component --}}
            <div>
                <label for="name" class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Article Title</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $article->title) }}"
                       required
                       class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150">
            </div>

            {{-- Article Description Component --}}
            <div>
                <label for="description" class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Article Description</label>
                <textarea id="description"
                          name="description"
                          rows="6"
                          required
                          class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150 resize-y">{{ old('description', $article->description) }}</textarea>
            </div>

            {{-- Active Storage Management Layer --}}
            @if ($article->image_path)
                <div id="current-image-block" class="border-t border-slate-100 dark:border-slate-800/60 pt-5">
                    <label class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-2">Active Cover Image (On Server)</label>
                    
                    <div class="flex items-center gap-4">
                        <div class="relative w-32 h-24 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-900 shadow-sm shrink-0">
                            <img id="current-image" src="{{ asset('storage/articles/' . $article->image_path) }}" alt="article Image" class="w-full h-full object-cover">
                        </div>

                        <div class="space-y-1">
                            <button type="button"
                                    id="remove-image-btn"
                                    class="px-3 py-1.5 bg-red-50 hover:bg-red-100 dark:bg-red-950/30 dark:hover:bg-red-900/40 border border-red-200/60 dark:border-red-900/40 text-red-700 dark:text-red-400 text-[14px] font-600 rounded-lg inline-flex items-center gap-1 cursor-pointer focus:outline-none transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Remove asset
                            </button>
                            <p class="text-[14px] text-slate-400 dark:text-slate-500 block">Flag this image storage reference for deletion upon record update.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Replace / Stage New Media Element Component --}}
            <div class="border-t border-slate-100 dark:border-slate-800/60 pt-5">
                <label class="block text-[16px] font-600 text-slate-700 dark:text-slate-300 mb-2">Upload Alternative Cover</label>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    {{-- File Picker Trigger --}}
                    <div class="md:col-span-2">
                        <div class="relative flex items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-5 bg-slate-50/40 dark:bg-slate-900/10 text-center">
                            <label for="image" class="cursor-pointer flex flex-col items-center group">
                                <span class="inline-flex items-center gap-2 px-3.5 py-2 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 text-[14px] font-600 rounded-xl shadow-sm group-hover:bg-slate-50 dark:group-hover:bg-slate-800 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Choose Alternative Image
                                </span>
                                <input type="file" id="image" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                        </div>
                    </div>

                    {{-- Staged Runtime File Canvas Preview --}}
                    <div id="preview-wrapper" class="hidden aspect-video md:aspect-auto md:h-[68px] rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center relative">
                        <img id="article-preview" src="#" alt="Staged Preview" class="w-full h-full object-cover">
                        <button type="button" id="clear-preview-btn" class="absolute top-1 right-1 w-5 h-5 bg-slate-900/80 hover:bg-red-600 text-white rounded-md flex items-center justify-center transition-colors focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Submission Component Actions Strip --}}
            <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end">
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[14px] font-600 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer focus:outline-none">
                    Update Article
                </button>
            </div>

        </form>
    </div>
</main>

{{-- Live Asset Preview Tracking Runtime Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeBtn = document.getElementById('remove-image-btn');
        const imageBlock = document.getElementById('current-image-block');
        const removeField = document.getElementById('remove_image_field');
        
        const imageInput = document.getElementById('image');
        const previewWrapper = document.getElementById('preview-wrapper');
        const previewImg = document.getElementById('article-preview');
        const clearBtn = document.getElementById('clear-preview-btn');

        // Server-Side Deletion Handler Flags
        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                if(confirm('Are you sure you want to flag the active server image file for absolute removal?')) {
                    removeField.value = '1';
                    if (imageBlock) {
                        imageBlock.remove();
                    }
                }
            });
        }

        // Fresh Staging Client-Side Read Operations
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                    previewWrapper.classList.remove('hidden');
                    previewWrapper.classList.add('animate-in', 'zoom-in-95', 'duration-150');
                    
                    // Auto-hide old server picture blocks if context changes
                    if (imageBlock) {
                        removeField.value = '1';
                        imageBlock.classList.add('opacity-40', 'pointer-events-none');
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Drop Newly Staged Asset Cache
        clearBtn.addEventListener('click', function() {
            imageInput.value = '';
            previewImg.setAttribute('src', '#');
            previewWrapper.classList.add('hidden');
            
            // Re-stabilize previous active image states if target cleared
            if (imageBlock) {
                removeField.value = '0';
                imageBlock.classList.remove('opacity-40', 'pointer-events-none');
            }
        });
    });
</script>

@include('layouts.footer')