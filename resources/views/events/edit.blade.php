<x-layouts.app :title="__('Edit Acara')">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-neutral-800">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Edit Acara') }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Perbarui detail acara Anda.') }}
                </p>
            </div>

            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Event Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nama Acara') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}"
                            required
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Deskripsi') }}
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Lokasi') }}
                        </label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $event->location) }}"
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Tanggal & Waktu Mulai') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="start_date" id="start_date"
                            value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" required
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Tanggal & Waktu Selesai') }}
                        </label>
                        <input type="datetime-local" name="end_date" id="end_date"
                            value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}"
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <a href="{{ route('events.show', $event) }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                        {{ __('Batal') }}
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        {{ __('Perbarui Acara') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
