@include('headerfooter.boiler')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">  
  @include('headerfooter.header')
  <main class="flex-grow p-6 items-center flex flex-col">
      <h1 class="text-3xl font-bold underline">Contact Us</h1>
      <p class="mt-4">Fill up this form to contact us</p>
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
      <form action="/submit-contact" method="POST" class="mt-6 space-y-4 w-full max-w-lg bg-[#1e2230] p-6 rounded-lg shadow-md">
          @csrf
          <div>
        <label for="name" class="block mb-1">Name:</label>
        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
        <label for="email" class="block mb-1">Email:</label>
        <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
        <label for="phone" class="block mb-1">Phone:</label>
        <input type="text" id="phone" name="phone" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
          <label for="subject" class="block mb-1">Subject:</label>
          <input type="text" id="subject" name="subject" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
          <label for="message" class="block mb-1">Message:</label>
          <textarea id="message" name="message" rows="5" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required></textarea>
          </div>
          <div>
          <label for="company" class="block mb-1">Company:</label>
          <input type="text" id="company" name="company" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
          <label for="country" class="block mb-1">Country:</label>
          <input type="text" id="country" name="country" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
          <label for="job_title" class="block mb-1">Job Title:</label>
          <input type="text" id="job_title" name="job_title" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required>
          </div>
          <div>
          <label for="job_details" class="block mb-1">Job Details:</label>
          <textarea id="job_details" name="job_details" rows="5" class="w-full p-2 border border-gray-300 rounded bg-white text-black" required></textarea>
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
      </form>
  </main>

  @include('headerfooter.footer')

</body>
</html>