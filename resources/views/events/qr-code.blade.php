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
                        {{ __('Scan this QR code to mark attendance') }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Attendance URL') }}</p>
                <div class="flex items-center space-x-2 w-full">
                    <input type="text" readonly value="{{ $event->getAttendanceUrl() }}"
                        class="w-full text-sm bg-gray-100 dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-md px-3 py-2">
                    <button onclick="copyToClipboard()"
                        class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                        {{ __('Copy') }}
                    </button>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('events.show', $event) }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    &larr; {{ __('Back to Event') }}
                </a>

                <div class="flex space-x-2">
                    <a href="#" onclick="printQR()"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        {{ __('Print') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const url = "{{ $event->getAttendanceUrl() }}";
            navigator.clipboard.writeText(url).then(function() {
                alert("{{ __('URL copied to clipboard!') }}");
            });
        }

        function printQR() {
            const content = document.querySelector('.bg-white');
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>{{ $event->name }} - QR Code</title>
                    <style>
                        body { font-family: Arial, sans-serif; text-align: center; }
                        .container { margin: 20px auto; max-width: 400px; }
                        h1 { margin-bottom: 5px; }
                        p { margin: 5px 0; color: #666; }
                        .qr-container { margin: 30px auto; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>{{ $event->name }}</h1>
                        <p>{{ $event->start_date->format('d M Y, H:i') }}</p>
                        @if ($event->location)
                            <p>{{ $event->location }}</p>
                        @endif
                        <div class="qr-container">
                            {!! QrCode::size(300)->generate($event->getAttendanceUrl()) !!}
                        </div>
                        <p>Scan to mark attendance</p>
                        <p style="margin-top: 20px; font-size: 12px;">{{ $event->getAttendanceUrl() }}</p>
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>
</x-layouts.app>
