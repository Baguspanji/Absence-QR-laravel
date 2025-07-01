<x-layouts.app :title="__('Tambah Peserta')">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-neutral-800">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Tambah Peserta') }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Tambahkan peserta baru ke') }}
                    "{{ $event->name }}"</p>
            </div>

            <form action="{{ route('attendees.store', $event) }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <!-- Attendee Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nama Lengkap') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- School -->
                    <div>
                        <label for="school" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Asal Sekolah') }}
                        </label>
                        <input type="text" name="school" id="school" value="{{ old('school') }}"
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('school')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nomor Telepon') }}
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="px-2 py-1 mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('phone')
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
                        {{ __('Tambah Peserta') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
