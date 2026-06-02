@php $pageTitle = 'Edit Event: ' . $event->name . ' — AI Studio'; @endphp
@include('layouts.header')

<main class="max-w-[850px] mx-auto px-6 py-10 flex-grow animate-in fade-in duration-200">

    {{-- Page Heading Row --}}
    <div class="mb-8">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-700 tracking-wider text-blue-600 dark:text-blue-400 uppercase bg-blue-500/10 border border-blue-500/20 mb-3">
            Event Management Pipeline
        </span>
        <h1 class="font-display text-[26px] font-700 text-slate-900 dark:text-slate-100 tracking-tight leading-[1.1]">Edit Event</h1>
        <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mt-1.5">Modify scheduled dates, update ticket rates, or change your promotional poster graphics.</p>
    </div>

    {{-- Form Context Workspace Card --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
        
        {{-- Success Alerts --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-400 px-4 py-3.5 rounded-xl text-[14px] font-500 mb-6 shadow-sm">
                <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
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

        {{-- Resource Submission Form (Points to update target stack) --}}
        <form action="{{ url('/update-events') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            {{-- Target Routing Payload References --}}
            <input type="hidden" name="id" value="{{ $event->id }}">

            {{-- Event Title Input Component --}}
            <div>
                <label for="name" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Event Name</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $event->name) }}"
                       required
                       class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-800/40 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:border-blue-500 transition-colors">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Event Date Field --}}
                <div>
                    <label for="date" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Schedule Date</label>
                    <input type="date"
                           id="date"
                           name="date"
                           value="{{ old('date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-b') : $event->date) }}"
                           required
                           class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-800/40 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:border-blue-500 transition-colors dark:[color-scheme:dark]">
                </div>

                {{-- Event Entry Cost Field --}}
                <div>
                    <label for="price" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Ticket Rate (NPR)</label>
                    <input type="number"
                           id="price"
                           name="price"
                           step="0.01"
                           value="{{ old('price', $event->price) }}"
                           placeholder="0.00"
                           required
                           class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-800/40 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:border-blue-500 transition-colors [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                </div>
            </div>

            {{-- Event Description Component --}}
            <div>
                <label for="description" class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Event Details & Agenda</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          class="w-full text-[14px] px-3.5 py-2.5 bg-slate-50 dark:bg-slate-800/40 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:border-blue-500 transition-colors resize-y">{{ old('description', $event->description) }}</textarea>
            </div>

            {{-- Promotional Media Input Component --}}
            <div>
                <label class="block text-[12px] font-700 uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Promotional Event Poster</label>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    {{-- Dropzone Input Trigger Box --}}
                    <div class="md:col-span-2">
                        <div class="relative flex items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-5 bg-slate-50/40 dark:bg-slate-900/10 text-center">
                            <label for="image" class="cursor-pointer flex flex-col items-center group">
                                <span class="inline-flex items-center gap-2 px-3.5 py-2 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-800 text-[12.5px] font-600 rounded-xl shadow-sm group-hover:bg-slate-50 dark:group-hover:bg-slate-800 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Replace Display Poster Asset
                                </span>
                                <input type="file" id="image" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                            </label>
                        </div>
                    </div>

                    {{-- Dynamic Active Server Image / Staging Preview View Node --}}
                    @php $hasImage = !empty($event->image); @endphp
                    <div id="preview-wrapper" class="{{ $hasImage ? '' : 'hidden' }} aspect-video md:aspect-auto md:h-[74px] rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center relative">
                        <img id="event-preview" 
                             src="{{ $hasImage ? asset('storage/events/' . $event->image) : '#' }}" 
                             alt="Staged Preview" 
                             class="w-full h-full object-cover">
                        <button type="button" id="clear-preview-btn" class="absolute top-1 right-1 w-5 h-5 bg-slate-900/80 hover:bg-red-600 text-white rounded-md flex items-center justify-center transition-colors focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Submission Panel Actions Strip --}}
            <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-end gap-3">
                <a href="{{ url()->previous() }}" class="px-[18px] py-2.5 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 text-[13.5px] font-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[13.5px] font-600 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer focus:outline-none">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</main>

{{-- Async File Stream Preview Engine --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const previewWrapper = document.getElementById('preview-wrapper');
        const previewImg = document.getElementById('event-preview');
        const clearBtn = document.getElementById('clear-preview-btn');

        // Track if there's an original image asset on setup
        const initialSrc = previewImg.getAttribute('src');

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
            
            // If there was an original server asset, decide whether to completely hide or clear input vector 
            if (initialSrc && initialSrc !== '#') {
                if (confirm('Do you want to discard your changes and restore the previous server poster display?')) {
                    previewImg.setAttribute('src', initialSrc);
                } else {
                    previewImg.setAttribute('src', '#');
                    previewWrapper.classList.add('hidden');
                }
            } else {
                previewImg.setAttribute('src', '#');
                previewWrapper.classList.add('hidden');
            }
        });
    });
</script>

@include('layouts.footer')