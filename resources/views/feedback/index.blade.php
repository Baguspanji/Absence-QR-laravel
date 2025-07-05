<x-layouts.app :title="__('Feedback')">
    <div class="py-12">
        <div class="mb-6 flex justify-between items-center px-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Feedback') }}
            </h2>
            <a href="{{ route('feedback.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                {{ __('Buat Feedback') }}
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if ($feedbacks->isEmpty())
                    <div class="p-6 text-gray-900 text-center">
                        <p class="mb-4">{{ __('Anda belum membuat feedback apapun.') }}</p>
                        <a href="{{ route('feedback.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Buat feedback pertama Anda') }}
                        </a>
                    </div>
                @else
                    <div class="overflow-hidden overflow-x-auto p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($feedbacks as $feedback)
                                <div
                                    class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                    <div class="p-4 bg-white">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-lg font-bold truncate flex-1">{{ $feedback->title }}</h3>
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $feedback->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $feedback->is_active ? 'Aktif' : 'Non-aktif' }}
                                            </span>
                                        </div>

                                        @if ($feedback->description)
                                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $feedback->description }}</p>
                                        @endif

                                        <div class="text-sm text-gray-500 mt-1">
                                            <div>
                                                <span class="font-semibold">{{ __('Dibuat:') }}</span>
                                                {{ $feedback->created_at->format('M d, Y') }}
                                            </div>
                                        </div>

                                        <div class="mt-2 text-sm">
                                            <span class="font-semibold">{{ __('Total Respon:') }}</span>
                                            {{ $feedback->getTotalResponsesCount() }}
                                        </div>

                                        <div class="mt-4 flex gap-2">
                                            <a href="{{ route('feedback.show', $feedback) }}"
                                                class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                                {{ __('Lihat') }}
                                            </a>
                                            <a href="{{ route('feedback.qrcode', $feedback) }}"
                                                class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                {{ __('Kode QR') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
