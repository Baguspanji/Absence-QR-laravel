<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-neutral-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Your Events') }}</h2>
                    <a href="{{ route('events.create') }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        {{ __('Create New Event') }}
                    </a>
                </div>

                <div id="event-list">
                    @php
                        $events = Auth::user()->events()->latest()->take(5)->get();
                    @endphp

                    @if ($events->isEmpty())
                        <div
                            class="text-center py-8 border rounded-lg border-dashed border-gray-300 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No events') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Get started by creating a new event.') }}</p>
                            <div class="mt-6">
                                <a href="{{ route('events.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    {{ __('Create Event') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($events as $event)
                                <div
                                    class="border rounded-lg overflow-hidden bg-white dark:bg-neutral-800 hover:shadow-md transition-shadow dark:border-gray-700">
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ $event->name }}</h3>
                                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <div>
                                                        <span class="font-medium">{{ __('Date:') }}</span>
                                                        {{ $event->start_date->format('M d, Y') }}
                                                    </div>
                                                    @if ($event->location)
                                                        <div>
                                                            <span class="font-medium">{{ __('Location:') }}</span>
                                                            {{ $event->location }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('events.show', $event) }}"
                                                    class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                    {{ __('Details') }}
                                                </a>
                                                <a href="{{ route('events.qrcode', $event) }}"
                                                    class="px-3 py-1 text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                                    {{ __('QR Code') }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mt-3 flex items-center text-sm">
                                            <div
                                                class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded text-xs">
                                                {{ $event->getCheckedInCount() }}/{{ $event->getTotalAttendeesCount() }}
                                                {{ __('Attendees') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4 text-center">
                                <a href="{{ route('events.index') }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                    {{ __('View All Events') }} →
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-neutral-800">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Quick Guide') }}</h2>
                <div class="space-y-4 text-gray-700 dark:text-gray-300">
                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">1</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Create an Event') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Start by creating a new event with details like name, date, and location.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">2</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Add Attendees') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Add attendees manually or import them from a CSV/Excel file.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">3</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Display QR Code') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Generate and display the QR code at your event for attendees to scan.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">4</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Track Attendance') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Monitor who has checked in in real-time from the event details page.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
