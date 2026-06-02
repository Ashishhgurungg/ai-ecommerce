@include('layouts.header')
<main class="flex-grow p-6">

    <h1 class="text-3xl font-bold underline">Reviews</h1>
    <p class="mt-4">Welcome to the reviews page.</p>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('delete'))
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('delete') }}
        </div>
    @endif

    <div class="space-y-6 mt-6">

        @forelse ($reviews ?? [] as $review)

            <div class="bg-[#1a1f2b] p-4 rounded shadow hover:shadow-lg transition">

                <h2 class="text-blue-500 text-xl font-semibold mb-2">
                    {{ $review->name }}
                </h2>

                <p class="text-[#b0b8c1] mb-4">
                    {{ $review->review }}
                </p>

                <div class="mt-3">
                    <a href="{{ url('/delete-review/' . $review->id) }}"
                       class="text-red-500 hover:underline">
                        Delete
                    </a>
                </div>

            </div>

        @empty

            <div class="text-center bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-6">
                {{ $message ?? 'No reviews available.' }}
            </div>

        @endforelse

    </div>
        {{-- Pagination --}}
    <div class="mt-6">
        {{ $reviews->links('pagination::tailwind') }}
    </div>


</main>
@include('layouts.footer')