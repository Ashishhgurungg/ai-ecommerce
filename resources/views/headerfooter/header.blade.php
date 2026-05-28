 {{-- HEADER (normal position) --}}
  <header class="bg-[#1f2937] text-[#d6dfed] margin-10">
    <nav class="flex justify-between items-center px-6 py-3">
      <div class="flex items-center gap-6">
        <a href="/">
          <img src="{{ asset('images/my-logo.svg') }}" alt="My Logo" class="block h-6 w-auto" />
        </a>
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Home</a>
        <a href="{{ url('/services') }}" class="{{ request()->is('services') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Services</a>
        <a href="{{ url('/event') }}" class="{{ request()->is('event') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Event</a>
        <a href="{{ url('/articles') }}" class="{{ request()->is('articles') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Articles</a>
        <a href="{{ url('/galleries') }}" class="{{ request()->is('galleries') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Gallery</a>
        <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">Contact Us</a>
        <a href="{{ url('/faq') }}" class="{{ request()->is('faq') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">FAQ</a>
        <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }}">About</a>
      </div>

      @if (Route::has('login'))
      <div class="flex items-center space-x-3">
        @auth
          <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 rounded-sm text-sm leading-normal hover:bg-blue-600">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 rounded-sm text-sm leading-normal border border-gray-300 hover:border-blue-600">Log in</a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 rounded-sm text-sm leading-normal border border-gray-300 hover:border-blue-600">Register</a>
          @endif
        @endauth
      </div>
      @endif
    </nav>
  </header>