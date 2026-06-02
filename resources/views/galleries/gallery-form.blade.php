@php $pageTitle = 'Create Gallery — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[850px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="mb-8">
        <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Add New Gallery</h1>
        <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Configure storage paths, context info, and populate mass media components.</p>
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

        {{-- Resource Submition Form --}}
        <form action="{{ url('/gallery-form') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Gallery Name Input Component --}}
            <div>
                <label for="name" class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Gallery Title</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="e.g., Summer Hackathon Recaps"
                       required
                       class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150">
            </div>

            {{-- Gallery Description Component --}}
            <div>
                <label for="description" class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Gallery Description</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          placeholder="Provide a functional engineering or corporate description regarding this album collection..."
                          required
                          class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150 resize-y">{{ old('description') }}</textarea>
            </div>

            {{-- Dynamic Storage Engine Upload Section --}}
            <div>
                <label class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-2">Gallery Images</label>
                
                {{-- Dropzone Layout UI Wrapper Trigger --}}
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-6 bg-slate-50/40 dark:bg-slate-900/10 flex flex-col items-center justify-center text-center transition-colors">
                    
                    <button type="button"
                            id="add-image-btn"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 text-[13px] font-600 rounded-xl shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer focus:outline-none transition-colors">
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Choose Image Files
                    </button>
                    <p class="text-[12px] text-slate-400 dark:text-slate-500 mt-2">Select PNG, JPG or WEBP image frames sequentially.</p>
                </div>

                {{-- Hidden Engine Elements --}}
                <input type="file" id="image-picker" accept="image/*" class="hidden">
                <input type="file" name="image[]" id="final-input" multiple class="hidden">

                {{-- Image Output Render Canvas Area --}}
                <div id="preview-container" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
            </div>

            {{-- Submission Controller Action Bar --}}
            <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end">
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[13.5px] font-600 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer focus:outline-none">
                    Add Gallery
                </button>
            </div>

        </form>
    </div>
</main>

{{-- File-Uploader Core Framework Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-image-btn');
        const picker = document.getElementById('image-picker');
        const finalInput = document.getElementById('final-input');
        const preview = document.getElementById('preview-container');

        let dataTransfer = new DataTransfer();

        addBtn.addEventListener('click', () => picker.click());

        picker.addEventListener('change', function() {
            Array.from(picker.files).forEach(file => {
                const exists = Array.from(dataTransfer.files).some(f =>
                    f.name === file.name && f.size === file.size
                );

                if (!exists) {
                    dataTransfer.items.add(file);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.className = "relative group aspect-square rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-900 shadow-sm animate-in zoom-in-95 duration-150";

                        wrapper.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-150 flex items-start justify-end p-1.5">
                                <button type="button"
                                        class="remove-btn w-6 h-6 bg-red-600 text-white rounded-lg flex items-center justify-center shadow hover:bg-red-700 focus:outline-none cursor-pointer transition-colors"
                                        data-filename="${file.name}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        `;

                        // Add action click handler inside modular scope setup
                        wrapper.querySelector('.remove-btn').addEventListener('click', function() {
                            const nameToClear = this.getAttribute('data-filename');
                            wrapper.remove();
                            removeImageFromFileBuffer(nameToClear);
                        });

                        preview.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });

            finalInput.files = dataTransfer.files;
            picker.value = "";
        });

        function removeImageFromFileBuffer(fileName) {
            let newData = new DataTransfer();
            Array.from(dataTransfer.files).forEach(file => {
                if (file.name !== fileName) {
                    newData.items.add(file);
                }
            });
            dataTransfer = newData;
            finalInput.files = dataTransfer.files;
        }
    });
</script>

@include('layouts.footer')