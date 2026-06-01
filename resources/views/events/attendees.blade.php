@include('layouts.header')
<body class="flex flex-col min-h-screen bg-[#0e121c] text-[#d6dfed]">
    <main class="flex-grow p-6">
        <h1 class="text-3xl font-bold mb-8 dark:bg-[#566b95] p-4 rounded">Attendees List for {{ $event->name }}</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if($attendees->isEmpty())
            <p class="text-gray-400">No attendees found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($attendees as $attendee)
                    <div class="bg-[#1a202c] border border-[#2d3748] rounded-lg p-6 shadow-lg hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-blue-400 mb-4">{{ $attendee->name }}</h3>

                        <div class="space-y-3 text-sm">
                            <div>
                                <label class="text-gray-400 font-medium">Email:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $attendee->email }}</p>
                            </div>
                            
                            <div>
                                <label class="text-gray-400 font-medium">Phone:</label>
                                <p class="text-[#d6dfed] mt-1">{{ $attendee->phone }}</p>
                            </div>
                        </div>
                        <a href="{{ url('/events/attendees/delete/' . $attendee->id) }}" class="text-red-500 hover:underline mt-4 block">Delete</a>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
@include('layouts.footer')