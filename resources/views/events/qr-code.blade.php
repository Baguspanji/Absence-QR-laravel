@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<x-layouts.app :title="$event->name . ' - ' . __('QR Code')">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-neutral-800">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">{{ $event->name }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->start_date->format('d M Y, H:i') }}</p>
                @if ($event->location)
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->location }}</p>
                @endif
            </div>

            <div class="mb-6">
                <div class="flex flex-col items-center">
                    <div class="p-2 bg-white rounded-lg">
                        {!! QrCode::size(250)->generate($event->getAttendanceUrl()) !!}
                    </div>
                    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Pindai kode QR ini untuk menandai kehadiran') }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('URL Absensi') }}</p>
                <div class="flex items-center space-x-2 w-full">
                    <input type="text" readonly value="{{ $event->getAttendanceUrl() }}"
                        class="w-full text-sm bg-gray-100 dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-md px-2 py-1">
                    <button onclick="copyToClipboard()"
                        class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                        {{ __('Salin') }}
                    </button>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('events.show', $event) }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    &larr; {{ __('Kembali ke Acara') }}
                </a>

                {{-- <div class="flex space-x-2">
                    <button type="button" onclick="printQR()"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        {{ __('Cetak') }}
                    </button>
                </div> --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyToClipboard() {
                const url = "{{ $event->getAttendanceUrl() }}";

                // Try using the clipboard API with fallback
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url)
                        .then(function() {
                            showToast("{{ __('URL disalin ke clipboard!') }}");
                        })
                        .catch(function() {
                            // Fallback method
                            fallbackCopyToClipboard(url);
                        });
                } else {
                    // Fallback for browsers without clipboard API
                    fallbackCopyToClipboard(url);
                }
            }

            // Fallback copy method using temporary input element
            function fallbackCopyToClipboard(text) {
                const textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    showToast("{{ __('URL disalin ke clipboard!') }}");
                } catch (err) {
                    console.error('Unable to copy to clipboard', err);
                    alert("{{ __('Tidak dapat menyalin URL. Silakan salin manual.') }}");
                }

                document.body.removeChild(textArea);
            }

            // Display a toast notification instead of an alert
            function showToast(message, isError = false) {
                const toast = document.createElement('div');
                toast.innerText = message;
                const bgColor = isError ? '#e74c3c' : '#333';
                toast.style.cssText =
                    `position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
                    background: ${bgColor}; color: white; padding: 10px 20px; border-radius: 4px;
                    z-index: 1000; box-shadow: 0 2px 8px rgba(0,0,0,0.2);`;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity 0.5s';
                    setTimeout(() => document.body.removeChild(toast), 500);
                }, isError ? 4000 : 2000);
            }

            function printQR() {
                //
            }
        </script>
    @endpush
</x-layouts.app>
