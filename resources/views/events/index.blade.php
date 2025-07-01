<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Acara') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                {{ __('Buat Acara') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if ($events->isEmpty())
                    <div class="p-6 text-gray-900 text-center">
                        <p class="mb-4">{{ __('Anda belum membuat acara apapun.') }}</p>
                        <a href="{{ route('events.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Buat acara pertama Anda') }}
                        </a>
                    </div>
                @else
                    <div class="overflow-hidden overflow-x-auto p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($events as $event)
                                <div
                                    class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                    <div class="p-4 bg-white">
                                        <h3 class="text-lg font-bold truncate">{{ $event->name }}</h3>
                                        <div class="text-sm text-gray-500 mt-1">
                                            <div>
                                                <span class="font-semibold">{{ __('Tanggal:') }}</span>
                                                {{ $event->start_date->format('M d, Y') }}
                                            </div>
                                            <div>
                                                <span class="font-semibold">{{ __('Waktu:') }}</span>
                                                {{ $event->start_date->format('H:i') }}
                                            </div>
                                            @if ($event->location)
                                                <div>
                                                    <span class="font-semibold">{{ __('Lokasi:') }}</span>
                                                    {{ $event->location }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-2 text-sm">
                                            <span class="font-semibold">{{ __('Kehadiran:') }}</span>
                                            {{ $event->getCheckedInCount() }}/{{ $event->getTotalAttendeesCount() }}
                                        </div>

                                        <div class="mt-4 flex gap-2">
                                            <a href="{{ route('events.show', $event) }}"
                                                class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                                {{ __('Lihat') }}
                                            </a>
                                            <a href="{{ route('events.qrcode', $event) }}"
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
