@include('layouts.header')
<main class="flex-grow p-6">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Title Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h3 class="font-semibold text-lg">Add your galleries here</h3>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Success --}}
                    @if (session('success'))
                    <div class="mb-4 p-3 rounded-md bg-green-100 text-green-800 border border-green-300">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Errors --}}
                    @if ($errors->any())
                    <div class="mb-4 p-3 rounded-md bg-red-100 text-red-800 border border-red-300">
                        <strong class="block font-semibold mb-1">Please fix the following errors:</strong>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ url('/gallery-form') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <label class="block mb-2 font-medium">Gallery Title:</label>
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200">

                        {{-- Description --}}
                        <label class="block mt-4 mb-2 font-medium">Gallery Description:</label>
                        <textarea name="description"
                            rows="3"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>

                        {{-- UPLOAD UX --}}
                        <label class="block mt-4 mb-2 font-medium">Gallery Images:</label>

                        <button type="button"
                            id="add-image-btn"
                            class="px-3 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">
                            + Add Image
                        </button>

                        {{-- hidden picker --}}
                        <input type="file"
                            id="image-picker"
                            accept="image/*"
                            class="hidden">

                        {{-- real input sent to backend --}}
                        <input type="file"
                            name="image[]"
                            id="final-input"
                            multiple
                            class="hidden">

                        {{-- preview grid --}}
                        <div id="preview-container"
                            class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">
                            Add Gallery
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- JS: One-by-one upload UX --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const addBtn = document.getElementById('add-image-btn');
            const picker = document.getElementById('image-picker');
            const finalInput = document.getElementById('final-input');
            const preview = document.getElementById('preview-container');

            let dataTransfer = new DataTransfer();

            // open file picker
            addBtn.addEventListener('click', () => {
                picker.click();
            });

            // handle selection
            picker.addEventListener('change', function() {

                Array.from(picker.files).forEach(file => {

                    // prevent duplicates
                    const exists = Array.from(dataTransfer.files).some(f =>
                        f.name === file.name && f.size === file.size
                    );

                    if (!exists) {
                        dataTransfer.items.add(file);

                        // preview card
                        const reader = new FileReader();
                        reader.onload = function(e) {

                            const wrapper = document.createElement('div');
                            wrapper.className = "relative group";

                            wrapper.innerHTML = `
                            <img src="${e.target.result}"
                                 class="w-full h-28 object-cover rounded border">

                            <button type="button"
                                    class="absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100"
                                    onclick="this.parentElement.remove(); removeImage('${file.name}')">
                                X
                            </button>
                        `;

                            preview.appendChild(wrapper);
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // update real input
                finalInput.files = dataTransfer.files;

                // reset picker
                picker.value = "";
            });

            // remove file from DataTransfer
            window.removeImage = function(fileName) {

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