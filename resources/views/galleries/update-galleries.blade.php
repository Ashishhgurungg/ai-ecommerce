@include('layouts.header')
    <main class="flex-grow p-6">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/update-galleries') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                @csrf
                <input type="hidden" name="id" value="{{ $gallery->id }}">

                {{-- Title --}}
                <label class="block mb-2 font-medium">Gallery Name:</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $gallery->title) }}"
                       class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                       required>

                {{-- Description --}}
                <label class="block mt-4 mb-2 font-medium">Gallery Description:</label>
                <textarea name="description"
                          class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                          rows="3">{{ old('description', $gallery->description) }}</textarea>

                {{-- ADD IMAGES BUTTON --}}
                <label class="block mt-4 mb-2 font-medium">Add Images:</label>

                <button type="button"
                        id="add-image-btn"
                        class="px-3 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">
                    + Add Image
                </button>

                <input type="file"
                       id="image-picker"
                       accept="image/*"
                       class="hidden">

                {{-- REAL INPUT SENT TO BACKEND --}}
                <input type="file"
                       name="image[]"
                       id="final-input"
                       multiple
                       class="hidden">

                {{-- PREVIEW --}}
                <div id="preview-container" class="flex gap-3 flex-wrap mt-4"></div>

                {{-- Remove all images --}}
                <input type="hidden" name="remove_all" id="remove_all_field" value="0">

                {{-- Current image preview --}}
                    @if (!empty($gallery->images) && count($gallery->images))
            <div id="current-image-block" class="mt-4">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mb-4">

                    @foreach ($gallery->images as $image)
                        <div class="relative group">

                            <img src="{{ asset('storage/galleries/' . $image) }}"
                                class="w-full h-28 object-cover rounded border">

                        </div>
                    @endforeach

                </div>

                <div class="flex items-center gap-3">

                    <button type="button"
                            id="remove-all-btn"
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                        Remove all images
                    </button>

                    <small class="text-gray-500">
                        Or add new images below.
                    </small>

                </div>

            </div>
        @endif

                {{-- Submit --}}
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Gallery
                </button>

            </form>

            {{-- JS FOR ONE-BY-ONE IMAGE ADD --}}
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

                    // ADD IMAGE BUTTON
                    addBtn.addEventListener('click', () => {
                        picker.click();
                    });

                    // PICK FILE ONE BY ONE
                    picker.addEventListener('change', function () {

                        for (let file of picker.files) {

                            dataTransfer.items.add(file);

                            // preview
                            let reader = new FileReader();
                            reader.onload = function (e) {
                                let img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = "w-24 h-24 object-cover rounded border";
                                preview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        }

                        // update real input
                        finalInput.files = dataTransfer.files;

                        picker.value = "";
                    });

                    // REMOVE ALL IMAGES
                    if (removeBtn) {
                        removeBtn.addEventListener('click', function () {
                            removeField.value = '1';
                            if (imageBlock) imageBlock.style.display = 'none';
                        });
                    }

                });
            </script>

        </div>
    </div>
@include('layouts.footer')
    </main>