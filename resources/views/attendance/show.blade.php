<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $event->name }} - {{ __('Absensi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-neutral-900">
    <div class="min-h-screen flex flex-col">
        <div class="py-4 bg-white dark:bg-neutral-800 shadow-sm">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold">{{ config('app.name') }}</h1>
                </div>
            </div>
        </div>

        <div class="flex-grow">
            <main class="py-6">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-neutral-800 shadow-sm sm:rounded-lg p-6">
                        @if (session('error'))
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif

                        <div class="mb-6 text-center">
                            <h2 class="text-2xl font-bold">{{ $event->name }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $event->start_date->format('d M Y, H:i') }}</p>
                            @if ($event->location)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->location }}</p>
                            @endif
                        </div>

                        @if ($pendingAttendees->isEmpty())
                            <div class="text-center py-8">
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    {{ __('Semua peserta telah melakukan check-in!') }}</p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Tidak ada lagi peserta yang menunggu untuk check-in.') }}</p>
                            </div>
                        @else
                            <div class="mb-4">
                                <label for="search"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Cari nama Anda') }}:</label>
                                <input type="text" id="search" placeholder="Ketik nama Anda di sini..."
                                    class="px-2 py-1 w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    onkeyup="searchAttendees()">
                            </div>

                            <div class="relative max-h-[400px] overflow-y-auto mt-4" id="attendees-list">
                                <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    {{ __('Pilih nama Anda dari daftar') }}:</h3>

                                <div class="space-y-2">
                                    @foreach ($pendingAttendees as $attendee)
                                        <div class="attendee-item border border-gray-200 dark:border-gray-700 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-neutral-700 cursor-pointer"
                                            data-name="{{ strtolower($attendee->name) }}"
                                            onclick="confirmAttendance({{ $attendee->id }}, '{{ $attendee->name }}')">
                                            <p class="font-medium">{{ $attendee->name }}</p>
                                            @if ($attendee->school)
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $attendee->school }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>

        <footer class="bg-white dark:bg-neutral-800 shadow-inner py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('Hak Cipta Dilindungi.') }}
                </p>
            </div>
        </footer>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-neutral-800 rounded-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4" id="modalTitle">
                    {{ __('Konfirmasi Kehadiran') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6" id="modalMessage"></p>

                <form id="attendanceForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="attendee_id" id="attendeeId">

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('Konfirmasi') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function searchAttendees() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const attendeeItems = document.querySelectorAll('.attendee-item');

            attendeeItems.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function confirmAttendance(id, name) {
            document.getElementById('attendeeId').value = id;
            document.getElementById('modalMessage').innerText = "{{ __('Anda akan ditandai hadir sebagai') }} " + name +
                ". {{ __('Lanjutkan?') }}";
            document.getElementById('attendanceForm').action =
                "{{ route('attendance.mark-present', $event->qr_code_token) }}";
            document.getElementById('confirmationModal').classList.replace('hidden', 'flex');
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.replace('flex', 'hidden');
        }

        // Close modal when clicking outside
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>
