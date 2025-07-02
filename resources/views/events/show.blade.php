<x-layouts.app :title="$event->name">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden dark:bg-neutral-800">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                    <div class="flex-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">{{ $event->name }}</h1>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 flex-shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate">{{ $event->start_date->format('M d, Y - H:i') }}</span>
                            </span>
                            @if ($event->end_date)
                                <span
                                    class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="truncate">{{ __('Berakhir') }}:
                                        {{ $event->end_date->format('M d, Y - H:i') }}</span>
                                </span>
                            @endif
                            @if ($event->location)
                                <span
                                    class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </span>
                            @endif
                        </div>
                        @if ($event->description)
                            <div class="mt-3 text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                {{ $event->description }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-2 lg:flex-nowrap lg:space-x-0 lg:space-y-0">
                        <a href="{{ route('events.qrcode', $event) }}"
                            class="flex-1 sm:flex-none p-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('QR') }}</span>
                        </a>
                        <a href="{{ route('events.export', $event) }}"
                            class="flex-1 sm:flex-none p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('Ekspor') }}</span>
                        </a>
                        <a href="{{ route('events.clone.form', $event) }}"
                            class="flex-1 sm:flex-none p-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('Duplikat') }}</span>
                        </a>
                        <a href="{{ route('events.edit', $event) }}"
                            class="flex-1 sm:flex-none p-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('Edit') }}</span>
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST"
                            class="flex-1 sm:flex-none"
                            onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus acara ini? Tindakan ini tidak dapat dibatalkan.') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full p-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span class="hidden sm:inline ml-1">{{ __('Hapus') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden dark:bg-neutral-800">
            <div
                class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between sm:items-center space-y-3 sm:space-y-0">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Peserta') }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Kelola peserta untuk acara ini') }}</p>
                </div>

                <div class="flex">
                    <a href="{{ route('attendees.create', $event) }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm w-full sm:w-auto text-center">
                        {{ __('Tambah Peserta') }}
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Total Peserta') }}: {{ $totalCount }} | {{ __('Telah Check-in') }}:
                        {{ $checkedInCount }}
                        @if ($totalCount > 0)
                            ({{ round(($checkedInCount / $totalCount) * 100) }}%)
                        @endif
                    </div>

                    <div class="w-full md:w-auto">
                        <div class="flex items-center mb-2 justify-start md:justify-end">
                            <a href="{{ route('attendees.template.download') }}"
                                class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                {{ __('Download Template') }}
                            </a>
                        </div>
                        <form action="{{ route('attendees.import', $event) }}" method="POST"
                            enctype="multipart/form-data"
                            class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                            @csrf
                            <input type="file" name="file" id="file" accept=".csv,.xlsx,.xls"
                                class="px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white dark:text-gray-400 dark:bg-neutral-900 dark:border-gray-700 focus:outline-none">
                            <button type="submit"
                                class="px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-sm w-full sm:w-auto">
                                {{ __('Impor') }}
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
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Tidak ada peserta') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Tambahkan peserta ke acara Anda.') }}</p>
                        <div class="mt-6">
                            <a href="{{ route('attendees.create', $event) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                {{ __('Tambah Peserta') }}
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Search input for attendees -->
                    <div class="mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="searchAttendee"
                                placeholder="{{ __('Cari nama atau sekolah...') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm dark:bg-neutral-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div id="searchInfo" class="mt-2 text-xs text-gray-500 dark:text-gray-400 hidden"></div>
                    </div>

                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Nama') }}
                                    </th>
                                    <th scope="col"
                                        class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                                        {{ __('Asal Sekolah') }}
                                    </th>
                                    <th scope="col"
                                        class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col"
                                        class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Aksi') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="attendeeTableBody"
                                class="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-gray-700">
                                @foreach ($attendees as $attendee)
                                    <tr class="attendee-row" data-name="{{ strtolower($attendee->name) }}"
                                        data-school="{{ strtolower($attendee->school ?? '') }}">
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $attendee->name }}
                                            </div>
                                            <!-- Mobile-only display of school -->
                                            <div class="sm:hidden mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                @if ($attendee->school)
                                                    <div>{{ $attendee->school }}</div>
                                                @endif
                                                @if ($attendee->phone)
                                                    <div>{{ $attendee->phone }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                @if ($attendee->school)
                                                    <div>{{ $attendee->school }}</div>
                                                @endif
                                                @if ($attendee->phone)
                                                    <div>{{ $attendee->phone }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                            @if ($attendee->hasCheckedIn())
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                    {{ __('Check-in pada') }}
                                                    {{ $attendee->attendance_time->format('H:i') }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    {{ __('Belum check-in') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('attendees.destroy', [$event, $attendee]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus peserta ini?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    {{ __('Hapus') }}
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

    <script>
        // Attendee search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchAttendee');
            const searchInfo = document.getElementById('searchInfo');

            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('#attendeeTableBody tr.attendee-row');
                    let visibleCount = 0;

                    rows.forEach(function(row) {
                        const name = row.getAttribute('data-name');
                        const school = row.getAttribute('data-school');

                        if (name.includes(searchValue) || school.includes(searchValue)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Update search info
                    if (searchValue.length > 0) {
                        searchInfo.classList.remove('hidden');
                        searchInfo.textContent = `${visibleCount} peserta ditemukan`;
                    } else {
                        searchInfo.classList.add('hidden');
                        searchInfo.textContent = '';
                    }
                });

                // Handle window resize for better mobile experience
                window.addEventListener('resize', function() {
                    if (window.innerWidth < 640) { // sm breakpoint in Tailwind
                        searchInput.placeholder = "{{ __('Cari peserta...') }}";
                    } else {
                        searchInput.placeholder = "{{ __('Cari nama atau sekolah...') }}";
                    }
                });

                // Initialize placeholder
                if (window.innerWidth < 640) {
                    searchInput.placeholder = "{{ __('Cari peserta...') }}";
                }
            }
        });
    </script>
</x-layouts.app>
