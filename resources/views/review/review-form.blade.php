@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">  
  @include('headerfooter.header')
  <main class="flex-grow p-6 items-center flex flex-col">
      <h1 class="text-3xl font-bold underline">Write a Review</h1>
      <p class="mt-4">Share your thoughts with us</p>
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
      <form action="/submit-review" method="POST" class="mt-6 space-y-4 w-full max-w-lg bg-[#1e2230] p-6 rounded-lg shadow-md">
          @csrf
          <div>
            <label for="name" class="block mb-1">Name:</label>
            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
            <label for="review" class="block mb-1">Review:</label>
            <textarea id="review" name="review" rows="5" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required></textarea>
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
      </form>
  </main>

  @include('headerfooter.footer')

</body>
</html>