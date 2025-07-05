<x-layouts.app :title="$feedback->title">
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
                        <div class="flex items-center gap-3">
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">{{ $feedback->title }}</h1>
                            <span class="px-2 py-1 text-xs rounded-full {{ $feedback->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $feedback->is_active ? 'Aktif' : 'Non-aktif' }}
                            </span>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 flex-shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate">{{ $feedback->created_at->format('M d, Y - H:i') }}</span>
                            </span>
                        </div>
                        @if ($feedback->description)
                            <div class="mt-3 text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                {{ $feedback->description }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-2 lg:flex-nowrap lg:space-x-0 lg:space-y-0">
                        <a href="{{ route('feedback.qrcode', $feedback) }}"
                            class="flex-1 sm:flex-none p-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('QR Code') }}</span>
                        </a>
                        <form action="{{ route('feedback.toggle-active', $feedback) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="flex-1 sm:flex-none p-2 {{ $feedback->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-md text-sm flex items-center justify-center">
                                <span class="hidden sm:inline">{{ $feedback->is_active ? 'Non-aktifkan' : 'Aktifkan' }}</span>
                                <span class="sm:hidden">{{ $feedback->is_active ? 'Off' : 'On' }}</span>
                            </button>
                        </form>
                        <a href="{{ route('feedback.edit', $feedback) }}"
                            class="flex-1 sm:flex-none p-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-sm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">{{ __('Edit') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-gray-50 px-6 py-4 dark:bg-neutral-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalResponses }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Total Respon') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $feedback->is_active ? 'Aktif' : 'Non-aktif' }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Status') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $feedback->created_at->diffForHumans() }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Dibuat') }}</div>
                    </div>
                </div>
            </div>

            <!-- Responses -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Respon Feedback') }}</h3>
                </div>

                @if ($responses->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m0 0v10a2 2 0 002 2h6a2 2 0 002-2V8M9 12h6" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Belum ada respon') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Belum ada yang memberikan feedback untuk topik ini.') }}
                        </p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($responses as $response)
                            <div class="bg-gray-50 rounded-lg p-4 dark:bg-neutral-700">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $response->name }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $response->school }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $response->submitted_at->format('M d, Y H:i') }}
                                    </span>
                                </div>
                                <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $response->feedback }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
