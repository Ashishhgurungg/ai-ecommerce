<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b2233] dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Event Attendees</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $attendeesCount ?? 0 }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Services</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $servicesCount ?? 0 }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Galleries</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $galleriesCount ?? 0 }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Events</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $eventsCount ?? 0 }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Event Attendees</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $attendeesCount ?? 0 }}</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Contact Messages</h3>
                    <p class="mt-4 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $inquiriesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
