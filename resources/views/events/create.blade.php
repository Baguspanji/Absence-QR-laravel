<x-layouts.app :title="__('Create Event')">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-neutral-800">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Create New Event') }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Fill in the details below to create a new event.') }}</p>
            </div>

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <!-- Event Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Event Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Description') }}
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Location') }}
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Start Date & Time') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            required
                            class="mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('End Date & Time') }}
                        </label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="mt-1 block w-full border-gray-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <a href="{{ route('events.index') }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        {{ __('Create Event') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
