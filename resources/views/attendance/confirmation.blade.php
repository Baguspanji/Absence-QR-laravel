<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $event->name }} - {{ __('Konfirmasi Kehadiran') }}</title>

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
                    <div class="bg-white dark:bg-neutral-800 shadow-sm sm:rounded-lg p-6 text-center">
                        <div class="mb-4">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ __('Kehadiran Tercatat!') }}</h2>

                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                {{ __('Terima kasih') }}, <span class="font-medium">{{ $attendee->name }}</span>.
                                {{ __('Kehadiran Anda telah berhasil dicatat pada pukul') }}
                                <span class="font-medium">{{ $attendee->attendance_time->format('H:i') }}</span>.
                            </p>

                            <div class="mb-8">
                                <h3 class="font-medium text-lg text-gray-900 dark:text-white mb-1">{{ $event->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $event->start_date->format('d M Y, H:i') }}</p>
                                @if ($event->location)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->location }}</p>
                                @endif
                            </div>

                            <a href="{{ route('attendance.show', $event->qr_code_token) }}"
                                class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                {{ __('Kembali ke Halaman Absensi') }}
                            </a>
                        </div>
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
</body>

</html>
