@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<x-layouts.app :title="$feedback->title . ' - ' . __('QR Code')">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-neutral-800">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">{{ $feedback->title }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $feedback->created_at->format('d M Y, H:i') }}</p>
                @if ($feedback->description)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $feedback->description }}</p>
                @endif
                <span class="inline-block mt-2 px-2 py-1 text-xs rounded-full {{ $feedback->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $feedback->is_active ? 'Aktif' : 'Non-aktif' }}
                </span>
            </div>

            <div class="mb-6">
                <div class="flex flex-col items-center">
                    <div class="p-2 bg-white rounded-lg">
                        {!! QrCode::size(250)->generate($feedback->getFeedbackUrl()) !!}
                    </div>
                    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Pindai kode QR ini untuk memberikan feedback') }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('URL Feedback') }}</p>
                <div class="flex items-center space-x-2 w-full">
                    <input type="text" readonly value="{{ $feedback->getFeedbackUrl() }}"
                        class="w-full text-sm bg-gray-100 dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-md px-2 py-1">
                    <button onclick="copyToClipboard()"
                        class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                        {{ __('Salin') }}
                    </button>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('feedback.show', $feedback) }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    &larr; {{ __('Kembali ke Feedback') }}
                </a>
            </div>

            <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900 rounded-md">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                            {{ __('Penting') }}
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                            <p>{{ __('Pastikan feedback dalam status aktif agar dapat menerima respon dari peserta.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const urlInput = document.querySelector('input[readonly]');
            urlInput.select();
            document.execCommand('copy');

            // Optional: Show a brief confirmation
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = '{{ __("Tersalin!") }}';
            setTimeout(() => {
                button.textContent = originalText;
            }, 2000);
        }
    </script>
</x-layouts.app>
