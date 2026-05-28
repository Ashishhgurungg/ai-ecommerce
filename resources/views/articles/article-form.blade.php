<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b2233] dark:text-gray-200 leading-tight">
            {{ __('Add articles') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-center">Add your Articles here</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                {{-- ✅ Success Message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 rounded-md bg-green-100 text-green-800 border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ❌ Validation Errors --}}
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

                <form action="{{ url('/article-form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        {{-- Article Title --}}
                        <label for="name" class="block mb-2 font-medium">Article Title:</label>
                        <input type="text" id="name" name="name"
                               class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200"
                               value="{{ old('name') }}" required>

                        {{-- Article Description --}}
                        <label for="description" class="block mt-4 mb-2 font-medium">Article Description:</label>
                        <textarea id="description" name="description" required
                                  class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200"
                                  rows="3">{{ old('description') }}</textarea>

                        {{-- Article Image --}}
                        <label for="image" class="block mt-4 mb-2 font-medium">Article Image:</label>
                        <input type="file" id="image" name="image"
                               class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:ring focus:ring-indigo-200">

                        <button type="submit"
                                class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">
                            Add Article
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</x-app-layout>
