<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $event->name }} - {{ __('Absensi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.0.18/24/outline/heroicons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/mini-quiz.js') }}"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }

        .attendee-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .attendee-card:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: translateY(-1px);
        }

        .modal-backdrop {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Mobile optimizations */
        @media (max-width: 640px) {
            .hover-lift:hover {
                transform: none;
                box-shadow: none;
            }

            .attendee-card:hover {
                transform: none;
            }

            .modal-content {
                margin: 1rem;
                max-height: 90vh;
                overflow-y: auto;
            }
        }

        /* Prevent zoom on input focus on iOS */
        @media screen and (-webkit-min-device-pixel-ratio: 0) {

            select:focus,
            textarea:focus,
            input:focus {
                font-size: 16px;
            }
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 min-h-screen">
    <!-- Header -->
    <header class="glass-effect border-b border-white/20 backdrop-blur-xl">
        <div class="max-w-4xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1
                        class="text-lg sm:text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-200 bg-clip-text text-transparent">
                        {{ config('app.name') }}
                    </h1>
                </div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium">
                    {{ now()->format('d M Y') }}
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 py-4 sm:py-8">
        <div class="max-w-4xl mx-auto px-3 sm:px-4 lg:px-8">
            <!-- Event Info Card -->
            <div
                class="fade-in bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl border border-white/20 rounded-2xl sm:rounded-3xl shadow-xl p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8">
                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-medium text-sm sm:text-base">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="text-center mb-6 sm:mb-8">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl sm:rounded-2xl mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2 px-2">
                        {{ $event->name }}</h2>
                    <div
                        class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-gray-600 dark:text-gray-300 text-sm sm:text-base">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ $event->start_date->format('d M Y, H:i') }}</span>
                        </div>
                        @if ($event->location)
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium text-center">{{ $event->location }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($pendingAttendees->isEmpty())
                    <div class="text-center py-8 sm:py-12">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-green-100 dark:bg-green-900/30 rounded-full mb-4 sm:mb-6">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2 px-4">
                            {{ __('Semua peserta telah melakukan check-in!') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-base sm:text-lg px-4">
                            {{ __('Tidak ada lagi peserta yang menunggu untuk check-in.') }}
                        </p>
                    </div>
                @else
                    <!-- Search Section -->
                    <div class="slide-up mb-6 sm:mb-8">
                        <label for="search"
                            class="block text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">
                            {{ __('Temukan nama Anda') }}
                        </label>
                        <div class="search-container">
                            <svg class="search-icon w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" id="search" placeholder="Ketik nama Anda di sini..."
                                class="w-full pl-10 sm:pl-12 pr-4 py-3 sm:py-4 text-base sm:text-lg border-2 border-gray-200 dark:border-gray-600 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm rounded-xl sm:rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 dark:text-white"
                                onkeyup="searchAttendees()">
                        </div>
                    </div>

                    <!-- Attendees List -->
                    <div class="slide-up">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                                {{ __('Daftar Peserta') }}
                            </h3>
                            <span
                                class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200">
                                {{ $pendingAttendees->count() }} {{ __('peserta') }}
                            </span>
                        </div>

                        <div class="max-h-80 sm:max-h-96 overflow-y-auto space-y-2 sm:space-y-3" id="attendees-list">
                            @foreach ($pendingAttendees as $attendee)
                                @php
                                    $attendeeName = htmlspecialchars(
                                        str_replace("'", '`', $attendee->name),
                                        ENT_QUOTES,
                                        'UTF-8',
                                    );
                                @endphp
                                <div class="attendee-item attendee-card bg-white/80 dark:bg-slate-700/80 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-5 cursor-pointer hover-lift"
                                    data-name="{{ strtolower($attendee->name) }}"
                                    data-original-name="{{ $attendee->name }}"
                                    onclick="confirmAttendance({{ $attendee->id }}, '{{ $attendeeName }}')">
                                    <div class="flex items-center space-x-3 sm:space-x-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="text-white font-bold text-sm sm:text-lg">{{ substr($attendee->name, 0, 1) }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p
                                                class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white truncate">
                                                {{ $attendee->name }}</p>
                                            @if ($attendee->school)
                                                <p
                                                    class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">
                                                    {{ $attendee->school }}</p>
                                            @endif
                                        </div>
                                        <div class="text-gray-400">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="glass-effect border-t border-white/20 backdrop-blur-xl py-4 sm:py-6">
        <div class="max-w-4xl mx-auto px-3 sm:px-4 lg:px-8">
            <p class="text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('Hak Cipta Dilindungi.') }}
            </p>
        </div>
    </footer>

    <!-- Enhanced Modal -->
    <div id="confirmationModal" class="fixed inset-0 modal-backdrop hidden items-center justify-center z-50 p-4">
        <div
            class="modal-content bg-white dark:bg-slate-800 rounded-2xl sm:rounded-3xl max-w-md w-full shadow-2xl border border-white/20 max-h-[90vh] overflow-y-auto">
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Modal Header -->
                <div class="text-center mb-4 sm:mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-xl sm:rounded-2xl mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2" id="modalTitle">
                        {{ __('Konfirmasi Kehadiran') }}
                    </h3>
                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 px-2" id="modalMessage"></p>
                </div>

                <!-- Quiz Section -->
                <div id="quizSection" class="mb-6 sm:mb-8">
                    <div
                        class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl sm:rounded-2xl p-4 sm:p-6 mb-4 sm:mb-6">
                        <h4
                            class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            {{ __('Mini Quiz') }}
                        </h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-3 sm:mb-4">
                            {{ __('Silakan jawab pertanyaan berikut untuk melanjutkan:') }}
                        </p>
                        <div id="quizQuestion"
                            class="text-sm sm:text-lg font-medium text-gray-800 dark:text-gray-200 mb-4"></div>
                    </div>

                    <div class="space-y-3 sm:space-y-4">
                        <input type="text" id="quizAnswer"
                            class="w-full px-3 sm:px-4 py-3 sm:py-4 text-base sm:text-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-slate-700 rounded-xl sm:rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 dark:text-white"
                            placeholder="{{ __('Ketik jawaban Anda di sini') }}">
                        <p id="quizError"
                            class="text-xs sm:text-sm text-red-600 dark:text-red-400 hidden items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Jawaban salah, silakan coba lagi!') }}
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <form id="attendanceForm" method="POST" action="" onsubmit="return validateQuiz()">
                    @csrf
                    <input type="hidden" name="attendee_id" id="attendeeId">
                    <input type="hidden" id="quizCorrectAnswer">

                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <button type="button" onclick="closeModal()"
                            class="w-full sm:flex-1 px-4 sm:px-6 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl sm:rounded-2xl text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-all duration-300">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit"
                            class="w-full sm:flex-1 px-4 sm:px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 border-2 border-transparent rounded-xl sm:rounded-2xl text-sm font-semibold text-white hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 transition-all duration-300">
                            {{ __('Konfirmasi') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function searchAttendees() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const attendeeItems = document.querySelectorAll('.attendee-item');

            attendeeItems.forEach((item, index) => {
                const name = item.getAttribute('data-name');
                if (name.includes(filter)) {
                    item.style.display = '';
                    item.style.animationDelay = `${index * 50}ms`;
                    item.classList.add('fade-in');
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function confirmAttendance(id, name) {
            document.getElementById('attendeeId').value = id;
            document.getElementById('modalMessage').innerText = "{{ __('Anda akan ditandai hadir sebagai') }} " + name +
                ". {{ __('Lanjutkan?') }}";
            document.getElementById('attendanceForm').action =
                "{{ route('attendance.mark-present', $event->qr_code_token) }}";

            const quiz = MiniQuiz.generateRandomQuiz();
            document.getElementById('quizQuestion').innerText = quiz.question;
            document.getElementById('quizCorrectAnswer').value = quiz.answer.toString();

            document.getElementById('quizError').classList.add('hidden');
            document.getElementById('quizAnswer').value = '';
            document.getElementById('confirmationModal').classList.replace('hidden', 'flex');

            setTimeout(() => {
                document.getElementById('quizAnswer').focus();
            }, 300);
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.replace('flex', 'hidden');
        }

        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target == this) closeModal();
        });

        // Quiz functions have been moved to mini-quiz.js

        function validateQuiz() {
            const userAnswer = document.getElementById('quizAnswer').value;
            const correctAnswer = document.getElementById('quizCorrectAnswer').value;

            if (!MiniQuiz.validateAnswer(userAnswer, correctAnswer)) {
                document.getElementById('quizError').classList.remove('hidden');
                return false;
            } else {
                document.getElementById('quizError').classList.add('hidden');
                return true;
            }
        }

        document.getElementById('quizAnswer').addEventListener('keypress', function(e) {
            if (e.key == 'Enter') {
                e.preventDefault();
                if (validateQuiz()) {
                    document.getElementById('attendanceForm').submit();
                }
            }
        });
    </script>
</body>

</html>
