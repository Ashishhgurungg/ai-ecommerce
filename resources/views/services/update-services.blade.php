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

            <form action="{{ url('/update-services') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    @csrf
    <input type="hidden" name="id" value="{{ $service->id }}">

    <label class="block mb-2 font-medium dark:text-white">Service Name:</label>
    <input type="text" name="name" value="{{ old('name', $service->name) }}" class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600" required>

    <label class="block mt-4 mb-2 font-medium dark:text-white">Service Description:</label>
    <textarea name="description" class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600" rows="3">{{ old('description', $service->description) }}</textarea>

    <label class="block mt-4 mb-2 font-medium dark:text-white">Service Image:</label>
    <input type="file" name="image" class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200">

    {{-- Hidden input to indicate removal; value = 1 when remove clicked --}}
    <input type="hidden" name="remove_image" id="remove_image_field" value="0">

    @if ($service->image_path)
        <div id="current-image-block" class="mt-2 flex items-start gap-4">
            <img id="current-image" src="{{ asset('storage/services/' . $service->image_path) }}" alt="Service Image" class="w-32 h-32 object-cover rounded border">

            <div class="flex flex-col gap-2">
                <button type="button" id="remove-image-btn" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">
                    Remove image
                </button>

                <small class="text-gray-500">Or upload a new image to replace it.</small>
            </div>
        </div>
    @endif

    <label class="block mt-4 mb-2 font-medium dark:text-white">Price:</label>
    <input type="number" name="price" value="{{ old('price', $service->price) }}" class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600" required>

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Update Service
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeBtn = document.getElementById('remove-image-btn');
        const imageBlock = document.getElementById('current-image-block');
        const removeField = document.getElementById('remove_image_field');

        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                // set hidden field so controller knows to remove on submit
                removeField.value = '1';

                // hide image preview immediately from UI
                if (imageBlock) {
                    imageBlock.style.display = 'none';
                }

                // Optionally show a small "removed" message (uncomment if you want)
                // const msg = document.createElement('div');
                // msg.className = 'mt-2 text-sm text-gray-600';
                // msg.innerText = 'Image will be removed when you submit the form.';
                // removeBtn.parentNode.appendChild(msg);
            });
        }
    });
</script>

        </div>
    </div>
</main>
@include('layouts.footer')