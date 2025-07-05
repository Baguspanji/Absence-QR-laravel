<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-neutral-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Acara Anda') }}</h2>
                    <a href="{{ route('events.create') }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        {{ __('Buat Acara Baru') }}
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
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tidak ada acara') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Mulai dengan membuat acara baru.') }}</p>
                            <div class="mt-6">
                                <a href="{{ route('events.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    {{ __('Buat Acara') }}
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
                                                        <span class="font-medium">{{ __('Tanggal:') }}</span>
                                                        {{ $event->start_date->format('M d, Y') }}
                                                    </div>
                                                    @if ($event->location)
                                                        <div>
                                                            <span class="font-medium">{{ __('Lokasi:') }}</span>
                                                            {{ $event->location }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('events.show', $event) }}"
                                                    class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                    {{ __('Detail') }}
                                                </a>
                                                <a href="{{ route('events.qrcode', $event) }}"
                                                    class="px-3 py-1 text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                                    {{ __('Kode QR') }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mt-3 flex items-center text-sm">
                                            <div
                                                class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded text-xs">
                                                {{ $event->getCheckedInCount() }}/{{ $event->getTotalAttendeesCount() }}
                                                {{ __('Peserta') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4 text-center">
                                <a href="{{ route('events.index') }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                    {{ __('Lihat Semua Acara') }} →
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-neutral-800">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Panduan Cepat') }}</h2>
                <div class="space-y-4 text-gray-700 dark:text-gray-300">
                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">1</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Buat Acara') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Mulai dengan membuat acara baru dengan detail seperti nama, tanggal, dan lokasi.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">2</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Tambah Peserta') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Tambahkan peserta secara manual atau impor dari file CSV/Excel.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">3</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Tampilkan Kode QR') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Buat dan tampilkan kode QR di acara Anda untuk dipindai oleh peserta.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="font-bold text-blue-600 dark:text-blue-300">4</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ __('Pantau Kehadiran') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Pantau siapa yang sudah check-in secara real-time dari halaman detail acara.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-neutral-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Feedback Terbaru') }}</h2>
                    <a href="{{ route('feedback.create') }}"
                        class="inline-flex items-center px-3 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700">
                        {{ __('Buat Feedback') }}
                    </a>
                </div>

                <div class="space-y-3">
                    @if ($feedbacks->isEmpty())
                        <div
                            class="text-center py-8 border rounded-lg border-dashed border-gray-300 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tidak ada feedback') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Mulai dengan membuat feedback baru.') }}</p>
                            <div class="mt-6">
                                <a href="{{ route('feedback.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700">
                                    {{ __('Buat Feedback') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($feedbacks as $feedback)
                                <div
                                    class="border rounded-lg overflow-hidden bg-white dark:bg-neutral-800 hover:shadow-md transition-shadow dark:border-gray-700">
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ $feedback->title }}</h3>
                                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <div>
                                                        <span class="font-medium">{{ __('Dibuat:') }}</span>
                                                        {{ $feedback->created_at->format('M d, Y') }}
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">{{ __('Status:') }}</span>
                                                        <span class="px-2 py-1 text-xs rounded-full {{ $feedback->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $feedback->is_active ? 'Aktif' : 'Non-aktif' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('feedback.show', $feedback) }}"
                                                    class="px-3 py-1 text-sm text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300">
                                                    {{ __('Detail') }}
                                                </a>
                                                <a href="{{ route('feedback.qrcode', $feedback) }}"
                                                    class="px-3 py-1 text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                                                    {{ __('QR Code') }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mt-3 flex items-center text-sm">
                                            <div
                                                class="bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300 px-2 py-1 rounded text-xs">
                                                {{ $feedback->getTotalResponsesCount() }} {{ __('Respon') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4 text-center">
                                <a href="{{ route('feedback.index') }}"
                                    class="text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300 text-sm">
                                    {{ __('Lihat Semua Feedback') }} →
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
