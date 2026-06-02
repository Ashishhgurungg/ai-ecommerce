@include('layouts.header')
    <main class="flex-grow p-6">
        <h1 class="text-3xl font-bold mb-8">Inquiries List</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if($inquiries->isEmpty())
            <p class="text-gray-400">No inquiries found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($inquiries as $inquiry)
                    <div class="bg-[#1a202c] border border-[#2d3748] rounded-lg p-6 shadow-lg hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-blue-400 mb-4">{{ $inquiry->subject }}</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div>
                                <label class="text-gray-400 font-medium">Name:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->name }}</p>
                            </div>
                            
                            <div>
                                <label class="text-gray-400 font-medium">Email:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->email }}</p>
                            </div>
                            
                            <div>
                                <label class="text-gray-400 font-medium">Phone:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->phone }}</p>
                            </div>
                            
                            <div>
                                <label class="text-gray-400 font-medium">Message:</label>
                                <p class="text-[#d6dfed] mt-1 line-clamp-2">{{ $inquiry->message }}</p>
                            </div>
                            <div>
                                <label class="text-gray-400 font-medium">Company:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->company }}</p>
                            </div>
                            <div>
                                <label class="text-gray-400 font-medium">Country:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->country }}</p>
                            </div>
                            <div>
                                <label class="text-gray-400 font-medium">Job Title:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $inquiry->job_title }}</p>
                            </div>
                            <div>
                                <label class="text-gray-400 font-medium">Job Details:</label>
                                <p class="text-[#d6dfed] mt-1 line-clamp-2">{{ $inquiry->job_details }}</p>
                            </div>
                        </div>
                        <a href="{{ url('/inquiries-delete/'.$inquiry->id) }}" class="text-red-500 hover:underline mt-4 block">Delete</a>
                    </div>
                @endforeach
            </div>
        @endif
            {{-- Pagination --}}
    <div class="mt-6">
        {{ $inquiries->links('pagination::tailwind') }}
    </div>
    </main>

@include('layouts.footer')