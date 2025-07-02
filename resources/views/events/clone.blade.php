<x-layouts.app :title="'Salin Acara' . ' - ' . $event->name">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden dark:bg-neutral-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Salin Acara</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Buat salinan dari "{{ $event->name }}"</p>
            </div>

            <div class="p-6">
                <form action="{{ route('events.clone', $event) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Acara</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $event->name . ' (Salinan)') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-gray-700 dark:text-gray-300" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="clone_attendees" id="clone_attendees" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:border-gray-700 dark:bg-neutral-900"
                                {{ old('clone_attendees', '1') === '1' ? 'checked' : '' }}>
                            <label for="clone_attendees" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Salin peserta juga
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ini akan menyalin semua peserta ke acara baru tanpa catatan kehadiran.</p>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('events.show', $event) }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md text-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                            Salin Acara
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
