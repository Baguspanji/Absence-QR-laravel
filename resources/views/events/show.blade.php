<x-layouts.app :title="$event->name">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden dark:bg-neutral-800">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $event->name }}</h1>
                        <div class="mt-1 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->start_date->format('M d, Y - H:i') }}
                            </span>
                            @if ($event->end_date)
                                <span
                                    class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('Ends') }}: {{ $event->end_date->format('M d, Y - H:i') }}
                                </span>
                            @endif
                            @if ($event->location)
                                <span
                                    class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $event->location }}
                                </span>
                            @endif
                        </div>
                        @if ($event->description)
                            <div class="mt-4 text-gray-700 dark:text-gray-300">
                                {{ $event->description }}
                            </div>
                        @endif
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('events.qrcode', $event) }}"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                            {{ __('QR Code') }}
                        </a>
                        <a href="{{ route('events.edit', $event) }}"
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-sm">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline"
                            onsubmit="return confirm('{{ __('Are you sure you want to delete this event? This action cannot be undone.') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden dark:bg-neutral-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Attendees') }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Manage attendees for this event') }}</p>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('attendees.create', $event) }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                        {{ __('Add Attendee') }}
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Total Attendees') }}: {{ $totalCount }} | {{ __('Checked In') }}:
                        {{ $checkedInCount }}
                        @if ($totalCount > 0)
                            ({{ round(($checkedInCount / $totalCount) * 100) }}%)
                        @endif
                    </div>

                    <div>
                        <form action="{{ route('attendees.import', $event) }}" method="POST"
                            enctype="multipart/form-data" class="flex items-center space-x-2">
                            @csrf
                            <input type="file" name="file" id="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white dark:text-gray-400 dark:bg-neutral-900 dark:border-gray-700 focus:outline-none">
                            <button type="submit"
                                class="px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-sm">
                                {{ __('Import') }}
                            </button>
                        </form>
                    </div>
                </div>

                @if ($attendees->isEmpty())
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No attendees') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Add attendees to your event.') }}</p>
                        <div class="mt-6">
                            <a href="{{ route('attendees.create', $event) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                {{ __('Add Attendee') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Contact') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-gray-700">
                                @foreach ($attendees as $attendee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $attendee->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                @if ($attendee->email)
                                                    <div>{{ $attendee->email }}</div>
                                                @endif
                                                @if ($attendee->phone)
                                                    <div>{{ $attendee->phone }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($attendee->hasCheckedIn())
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                    {{ __('Checked in at') }}
                                                    {{ $attendee->attendance_time->format('H:i') }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ __('Not checked in') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('attendees.destroy', [$event, $attendee]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('{{ __('Are you sure you want to remove this attendee?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    {{ __('Remove') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
