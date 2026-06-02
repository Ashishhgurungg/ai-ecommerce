@php $pageTitle = 'Edit Gallery — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[850px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="mb-8">
        <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Edit Gallery</h1>
        <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Modify collection attributes, manage existing assets, or batch append images.</p>
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
        <form action="{{ url('/update-galleries') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="id" value="{{ $gallery->id }}">
            <input type="hidden" name="remove_all" id="remove_all_field" value="0">

            {{-- Gallery Name Input Component --}}
            <div>
                <label for="name" class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Gallery Title</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $gallery->title) }}"
                       required
                       class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150">
            </div>

            {{-- Gallery Description Component --}}
            <div>
                <label for="description" class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-1.5">Gallery Description</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          required
                          class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 transition-all duration-150 resize-y">{{ old('description', $gallery->description) }}</textarea>
            </div>

            {{-- Existing Server Images Management Section --}}
            @if (!empty($gallery->images) && count($gallery->images))
                <div id="current-image-block" class="border-t border-slate-100 dark:border-slate-800/60 pt-5">
                    <div class="flex items-center justify-between gap-4 mb-3">
                        <label class="block text-[13px] font-600 text-slate-700 dark:text-slate-300">Active Gallery Images (On Server)</label>
                        <button type="button"
                                id="remove-all-btn"
                                class="text-[12px] font-600 text-red-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 flex items-center gap-1 cursor-pointer focus:outline-none">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Purge existing items
                        </button>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($gallery->images as $image)
                            <div class="relative aspect-square rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-900 shadow-sm">
                                <img src="{{ asset('storage/galleries/' . $image) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Dynamic Staging Media Uploader Dropzone --}}
            <div class="border-t border-slate-100 dark:border-slate-800/60 pt-5">
                <label class="block text-[13px] font-600 text-slate-700 dark:text-slate-300 mb-2">Stage New Media Assets</label>
                
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-6 bg-slate-50/40 dark:bg-slate-900/10 flex flex-col items-center justify-center text-center">
                    <button type="button"
                            id="add-image-btn"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 text-[13px] font-600 rounded-xl shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer focus:outline-none transition-colors">
                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Choose Image Files
                    </button>
                    <p class="text-[12px] text-slate-400 dark:text-slate-500 mt-2">Append new items seamlessly to this storage record context.</p>
                </div>

                {{-- Hidden Core Nodes --}}
                <input type="file" id="image-picker" accept="image/*" class="hidden">
                <input type="file" name="image[]" id="final-input" multiple class="hidden">

                {{-- Staging Render Canvas Area --}}
                <div id="preview-container" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
            </div>

            {{-- Control Action Footer Submition Strip --}}
            <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end">
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[13.5px] font-600 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer focus:outline-none">
                    Update Gallery
                </button>
            </div>

        </form>
    </div>
</main>

{{-- File-Uploader Core Framework Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addBtn = document.getElementById('add-image-btn');
        const picker = document.getElementById('image-picker');
        const finalInput = document.getElementById('final-input');
        const preview = document.getElementById('preview-container');

        const removeBtn = document.getElementById('remove-all-btn');
        const removeField = document.getElementById('remove_all_field');
        const imageBlock = document.getElementById('current-image-block');

        let dataTransfer = new DataTransfer();

        addBtn.addEventListener('click', () => picker.click());

        picker.addEventListener('change', function () {
            Array.from(picker.files).forEach(file => {
                const exists = Array.from(dataTransfer.files).some(f =>
                    f.name === file.name && f.size === file.size
                );

                if (!exists) {
                    dataTransfer.items.add(file);

                    const reader = new FileReader();
                    reader.onload = function (e) {
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

        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                if(confirm('Are you sure you want to flag all currently active server images for removal?')) {
                    removeField.value = '1';
                    if (imageBlock) imageBlock.remove();
                }
            });
        }
    });
</script>

@include('layouts.footer')